import React from 'react';
import { FlatList, Alert } from 'react-native';
import { APP } from '../../../App/Init/AppProvider';
import { Header } from '../../../Layouts/Components/Private/Header/Header';
import { ProductCard } from '../../../Layouts/Components/Private/ProductCard/ProductCard';

class Products extends React.Component<any, any> {
    public state: any;

    constructor(props: any) {
        super(props);

        this.state = {
            CategoryId: this.props.route.params.categoryId,
            CategoryName: this.props.route.params.categoryName,

            Products: [],
        };


        this.getProducts = this.getProducts.bind(this);
    }

    private getProducts(): void {
        APP.SERVICES.HTTPRequest.send('get', `/products?category_id=${this.state.CategoryId}`, {}, {}, (data: any) => {
            this.setState({ Products: data.data });
        });
    }

    public componentDidMount(): void {
        this.getProducts();
    }

    public componentDidUpdate(prevProps: any, prevState: any) {
        if (this.props.route.params.categoryId !== prevProps.route.params.categoryId) {
            this.setState({
                CategoryId: this.props.route.params.categoryId,
                CategoryName: this.props.route.params.categoryName,
                Products: [],
            }, () => {
                this.getProducts();
            });
        }
    }

    public render(): any {
        const renderItem = ({ item }: any) => (
            <ProductCard data={item} onPress={() => {
                Alert.alert("Product Info", `Name: ${item.name}\nPrice: ${item.price}\nDescription: ${item.description}`);
            }} />
        );


        return (
            <React.Fragment>
                <Header
                    navigation={this.props.navigation} title={this.state.CategoryName}
                    showBackAction={true}
                    showNewOrderAction={true} />

                <FlatList
                    data={this.state.Products}
                    renderItem={renderItem}
                    keyExtractor={(item: any) => item.id}
                    numColumns={2}
                    style={{ paddingLeft: 10, paddingRight: 10, paddingTop: 10, paddingBottom: 10, marginBottom: 20 }}
                />
            </React.Fragment>
        );
    }
}

export default Products;
