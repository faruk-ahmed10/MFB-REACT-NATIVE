import axios from 'axios';
import React from 'react';
import { ScrollView, View, Text, Picker, Alert } from 'react-native';
import { APP } from '../../../App/Init/AppProvider';
import { Button } from '../../../Layouts/Components/Global/Button/Button';
import { TextField } from '../../../Layouts/Components/Global/TextField/TextField';
import { Header } from '../../../Layouts/Components/Private/Header/Header';

const ProductCard: any = ({ productName, unitPrice, quantity, totalPrice, onRemove, index }: any) => (
    <View style={{ paddingLeft: 10, paddingRight: 10, paddingTop: 10, paddingBottom: 10, backgroundColor: "#ffffff", borderColor: "#000000", borderWidth: 1, borderRadius: 4, marginBottom: 20 }}>
        <View style={{ flexDirection: "row" }}>
            <Text style={{ fontWeight: "bold" }}>Name: </Text>
            <Text>{productName}</Text>
        </View>

        <View style={{ flexDirection: "row" }}>
            <Text style={{ fontWeight: "bold" }}>Unit Price: </Text>
            <Text>{unitPrice}</Text>
        </View>

        <View style={{ flexDirection: "row" }}>
            <Text style={{ fontWeight: "bold" }}>Quantity: </Text>
            <Text>{quantity}</Text>
        </View>

        <View style={{ flexDirection: "row" }}>
            <Text style={{ fontWeight: "bold" }}>Total Price: </Text>
            <Text>{totalPrice}</Text>
        </View>

        <Button label={"Remove"} icon="delete" mode={"contained"} onPress={() => onRemove(index)} style={{ marginTop: 10, backgroundColor: "red" }} />
    </View>
);


export class SalesOrderForm extends React.Component<any, any> {
    public state: any;

    public constructor(props: any) {
        super(props);

        this.state = {
            OrderId: '',
            CustomerName: '',
            CustomerAddress: '',
            CustomerPhone: '',
            Comment: '',
            InvoiceTotalPrice: 0,

            CategoryList: [],
            ProductList: [],
            CartItemList: [],

            SelectedCategoryId: 0,
            SelectedProductId: 0,
            SelectedProductName: '',
            UnitPrice: '',
            Quantity: '',
            TotalPrice: '',
        };

        this.getCategoryList = this.getCategoryList.bind(this);
        this.getProductList = this.getProductList.bind(this);
        this.addToCart = this.addToCart.bind(this);
        this.removeFromCart = this.removeFromCart.bind(this);
        this.calculateInvoiceTotalPrice = this.calculateInvoiceTotalPrice.bind(this);
        this.saveOrder = this.saveOrder.bind(this);
    }

    private getCategoryList(): void {
        APP.SERVICES.HTTPRequest.send('get', '/categories', {}, {}, (data: any) => {
            this.setState({ CategoryList: data.data });
        });
    }

    private getProductList(): void {
        this.setState({ ProductList: [], SelectedProductId: 0, UnitPrice: '', Quantity: '', TotalPrice: '', }, () => {
            APP.SERVICES.HTTPRequest.send('get', `/products?category_id=${this.state.SelectedCategoryId}`, {}, {}, (data: any) => {
                this.setState({ ProductList: data.data });
            });
        });
    }


    private addToCart(): void {
        const CartItemList = this.state.CartItemList;
        CartItemList.push({
            product_id: this.state.SelectedProductId,
            product_name: this.state.SelectedProductName,
            unit_price: this.state.UnitPrice,
            quantity: this.state.Quantity,
            total_price: this.state.TotalPrice,
        });

        this.setState({
            CartItemList,
            Quantity: '',
            TotalPrice: ''
        }, () => {
            this.calculateInvoiceTotalPrice();
            Alert.alert('Done', 'Item added to the cart!');
        });
    }

    private removeFromCart(index: number): void {
        const CartItemList = this.state.CartItemList;
        CartItemList.splice(index, 1);

        this.setState({ CartItemList }, () => {
            this.calculateInvoiceTotalPrice();
            Alert.alert('Done', 'Item removed from the cart!');
        });
    }

    private calculateInvoiceTotalPrice(): void {
        const CartItemList = this.state.CartItemList;
        let InvoiceTotalPrice = 0;

        for (let i = 0; i < CartItemList.length; i++) {
            InvoiceTotalPrice += Number(CartItemList[i].total_price);
        }

        this.setState({ InvoiceTotalPrice });
    }


    private saveOrder(): void {
        if (this.state.CustomerName.trim() === '') {
            alert('Enter customer name!');
            return;
        }

        if (this.state.CustomerPhone.trim() === '') {
            alert('Enter customer phone!');
            return;
        }

        if (this.state.CustomerAddress.trim() === '') {
            alert('Enter customer address!');
            return;
        }

        if (this.state.CartItemList.length < 1) {
            alert('Please add some items!');
            return;
        }

        APP.SERVICES.HTTPRequest.send('post', `/save_order`, {}, {
            OrderId: this.state.OrderId,
            CustomerName: this.state.CustomerName,
            CustomerAddress: this.state.CustomerAddress,
            CustomerPhone: this.state.CustomerPhone,
            Comment: this.state.Comment,
            InvoiceTotalPrice: this.state.InvoiceTotalPrice,
            CartItemList: this.state.CartItemList,
        }, (data: any) => {
            alert(data.message);
            this.props.navigation.goBack();
        });
    }


    public componentDidMount(): void {
        this.getCategoryList();
    }

    public render(): any {
        return (
            <React.Fragment>
                <Header navigation={this.props.navigation} title={"Sales Order Entry"}
                    showBackAction={true} showSaveAction={true} onSavePress={this.saveOrder} />
                <ScrollView style={{ paddingLeft: 10, paddingRight: 10, }}>
                    <Text style={{ fontWeight: "bold", fontSize: 16, marginTop: 10, marginBottom: 5 }}>Customer Details</Text>
                    <TextField
                        label={"Customer Name"}
                        value={this.state.CustomerName}
                        onChange={(value: any) => this.setState({
                            CustomerName: value,
                        })}
                        mode="outlined"
                        style={{ marginBottom: 10 }}
                        dense={true}
                    />

                    <TextField
                        label={"Customer Phone"}
                        value={this.state.CustomerPhone}
                        onChange={(value: any) => {
                            let __value: any = '';
                            if (Number(value) >= 0 && Number(value).toString() !== 'NaN') {
                                __value = Number(value);
                            }

                            this.setState({
                                CustomerPhone: __value.toString(),
                            });
                        }}
                        mode="outlined"
                        style={{ marginBottom: 20 }}
                        dense={true}
                    />

                    <TextField
                        label={"Customer Address"}
                        value={this.state.CustomerAddress}
                        onChange={(value: any) => this.setState({
                            CustomerAddress: value,
                        })}
                        mode="outlined"
                        style={{ marginBottom: 20 }}
                        dense={true}
                    />

                    <TextField
                        label={"Comment"}
                        value={this.state.Comment}
                        onChange={(value: any) => this.setState({
                            Comment: value,
                        })}
                        mode="outlined"
                        style={{ marginBottom: 20 }}
                        dense={true}
                    />



                    <Text style={{ fontWeight: "bold", fontSize: 16, marginTop: 10, marginBottom: 10 }}>Product Details</Text>
                    <Text style={{ fontSize: 14, marginBottom: 5 }}>Select Category</Text>
                    <View style={{ borderColor: "#737373", borderWidth: 1, borderRadius: 5, marginBottom: 15 }}>
                        <Picker
                            selectedValue={this.state.SelectedCategoryId}
                            style={{ borderColor: "red", borderWidth: 1 }}
                            mode="dropdown"
                            onValueChange={(itemValue, itemIndex) => this.setState({ SelectedCategoryId: itemValue }, () => {
                                this.getProductList();
                            })}>
                            <Picker.Item label={"-- Select Category --"} value={""} />
                            {this.state.CategoryList.map((Category: any, index: number) => (
                                <Picker.Item label={Category.name} value={Category.id} key={index} />
                            ))}
                        </Picker>
                    </View>

                    {this.state.ProductList.length > 0 && (
                        <React.Fragment>
                            <Text style={{ fontSize: 14, marginBottom: 5 }}>Select Product</Text>
                            <View style={{ borderColor: "#737373", borderWidth: 1, borderRadius: 5, marginBottom: 10 }}>
                                <Picker
                                    selectedValue={this.state.SelectedProductId}
                                    style={{ borderColor: "red", borderWidth: 1 }}
                                    mode="dropdown"
                                    onValueChange={(itemValue, itemIndex) => {
                                        if (itemValue !== '' && itemValue !== 0) {
                                            this.setState({ SelectedProductId: itemValue }, () => {
                                                let __unitPrice: string = '0';
                                                let __productName: string = '';
                                                try {
                                                    __unitPrice = String(this.state.ProductList[itemIndex].price);
                                                    __productName = this.state.ProductList[itemIndex].name;
                                                } catch (error) {
                                                    __unitPrice = '0';
                                                }

                                                this.setState({ SelectedProductName: __productName, UnitPrice: __unitPrice });
                                            });
                                        }
                                    }}>
                                    <Picker.Item label={"-- Select Product --"} value={""} />
                                    {this.state.ProductList.map((Product: any, index: number) => (
                                        <Picker.Item label={Product.name} value={Product.id} key={index} />
                                    ))}
                                </Picker>
                            </View>
                        </React.Fragment>
                    )}


                    <View style={{ flexDirection: 'row' }}>
                        <TextField
                            label={"Unit Price"}
                            value={this.state.UnitPrice}
                            mode="outlined"
                            style={{ marginBottom: 20, width: "48%" }}
                            dense={true}
                            disabled={true}
                        />

                        <TextField
                            label={"Quantity"}
                            value={this.state.Quantity}
                            onChange={(value: any) => {
                                const __qty = Number(value);
                                const __unitPrice = Number(this.state.UnitPrice);
                                const __totalPrice = (__qty * __unitPrice).toString();

                                this.setState({
                                    Quantity: __qty.toString(),
                                    TotalPrice: (__totalPrice === 'NaN') ? '0' : __totalPrice,
                                });
                            }}
                            mode="outlined"
                            style={{ marginBottom: 0, marginLeft: "4%", width: "48%" }}
                            dense={true}
                        />
                    </View>

                    <TextField
                        label={"Total Price"}
                        value={this.state.TotalPrice}
                        mode="outlined"
                        style={{ marginBottom: 20 }}
                        dense={true}
                        disabled={true}
                    />

                    {Number(this.state.Quantity) > 0 && (
                        <Button label={"Add"} mode={"contained"} onPress={this.addToCart} style={{ marginBottom: 20 }} />
                    )}

                    {this.state.CartItemList.length > 0 && (
                        <React.Fragment>
                            <Text style={{ fontWeight: "bold", fontSize: 16, marginTop: 40, marginBottom: 10 }}>Products</Text>
                            {this.state.CartItemList.map((Product: any, index: number) => {
                                return (
                                    <ProductCard productName={Product.product_name} unitPrice={Product.unit_price} quantity={Product.quantity} totalPrice={Product.total_price} key={index} onRemove={(index: any) => this.removeFromCart(index)} index={index} />
                                );
                            })}
                        </React.Fragment>
                    )}


                    <View style={{ borderColor: "#000000", borderWidth: 1, borderRadius: 4, backgroundColor: "#ffffff", alignItems: "center", alignContent: "center", paddingLeft: 10, paddingRight: 10, paddingTop: 10, paddingBottom: 10, marginBottom: 20 }}>
                        <Text style={{ fontSize: 18, fontWeight: "bold" }}>Invoice Total: {this.state.InvoiceTotalPrice}</Text>
                    </View>
                </ScrollView>
            </React.Fragment >
        )
    }
}