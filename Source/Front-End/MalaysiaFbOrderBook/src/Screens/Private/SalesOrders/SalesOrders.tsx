import React from 'react';
import { StyleSheet, View, ScrollView, Text } from 'react-native';
import { APP } from '../../../App/Init/AppProvider';
import { Header } from '../../../Layouts/Components/Private/Header/Header';
import Ripple from 'react-native-material-ripple';


const OrderCard: any = ({ orderId, customerName, customerPhone, customerAddress, comment, totalAmount, dateTime, onPress }: any) => (
    <Ripple rippleColor="#000000" onPress={onPress} style={{marginBottom: 20}}>
        <View style={{ paddingLeft: 10, paddingRight: 10, paddingTop: 10, paddingBottom: 10, backgroundColor: "#ffffff", borderColor: "#000000", borderWidth: 1, borderRadius: 4 }}>
            <View style={{ flexDirection: "row" }}>
                <Text>{dateTime}</Text>
            </View>

            <View style={{ flexDirection: "row" }}>
                <Text style={{ fontWeight: "bold" }}>Order Id: </Text>
                <Text>{orderId}</Text>
            </View>

            <View style={{ flexDirection: "row" }}>
                <Text style={{ fontWeight: "bold" }}>Customer Name: </Text>
                <Text>{customerName}</Text>
            </View>

            <View style={{ flexDirection: "row" }}>
                <Text style={{ fontWeight: "bold" }}>Customer Phone: </Text>
                <Text>{customerPhone}</Text>
            </View>

            <View style={{ flexDirection: "row" }}>
                <Text style={{ fontWeight: "bold" }}>Customer Address: </Text>
                <Text>{customerAddress}</Text>
            </View>

            <View style={{ flexDirection: "row" }}>
                <Text style={{ fontWeight: "bold" }}>Comment: </Text>
                <Text>{comment}</Text>
            </View>

            <View style={{ flexDirection: "row" }}>
                <Text style={{ fontWeight: "bold" }}>Total Amount: </Text>
                <Text>{totalAmount}</Text>
            </View>
        </View>
    </Ripple>
);

export class SalesOrders extends React.Component<any, any> {
    public state: any;
    private _unsubscribe: any;

    public constructor(props: any) {
        super(props);

        this.state = {
            OrderList: [],
        };
    }

    private getOrderList(): void {
        this.setState({ OrderList: [] }, () => {
            APP.SERVICES.HTTPRequest.send('get', `/get_orders`, {}, {}, (data: any) => {
                this.setState({ OrderList: data.data });
            });
        });
    }

    public componentDidMount(): void {
        this.getOrderList();

        this._unsubscribe = this.props.navigation.addListener('focus', () => {
            this.getOrderList();
        });
    }

    public componentWillUnmount(): void {
        this._unsubscribe();
    }

    public render(): any {
        const state = this.state;
        return (
            <React.Fragment>
                <Header navigation={this.props.navigation} title={"Sales Orders"}
                    showBackAction={true} />

                <ScrollView style={{ paddingLeft: 10, paddingRight: 10, marginTop: 12, }}>
                    {this.state.OrderList.map((Order: any, index: number) => (
                        <OrderCard orderId={Order.id} customerName={Order.customer_name} customerPhone={Order.customer_phone} customerAddress={Order.customer_address} comment={Order.comment} totalAmount={Order.total_price} dateTime={Order.date_time} onPress={() => {console.log('hi')}} key={index} />
                    ))}
                </ScrollView>
            </React.Fragment>
        )
    }
}


const styles = StyleSheet.create({
    container: { flex: 1, padding: 16, paddingTop: 30, backgroundColor: '#fff' },
    head: { height: 40, backgroundColor: '#f1f8ff' },
    text: { margin: 6 }
});