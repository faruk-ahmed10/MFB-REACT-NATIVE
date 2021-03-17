import React from 'react';
import { View, Text, Button, StyleSheet } from 'react-native';
import Ripple from 'react-native-material-ripple';
import Icon from 'react-native-vector-icons/MaterialCommunityIcons';
import { APP } from '../../../../App/Init/AppProvider';

export const QuickButtons = ({ navigation }: any) => (
    <React.Fragment>
        <View style={{ marginTop: 20 }}>
            <View style={{ flexDirection: 'row' }}>
                <View style={{ ...Styles.cardContainer, paddingRight: 15 }}>
                    <Ripple rippleColor="#ffffff" style={Styles.card} onPress={() => navigation.navigate('Categories')}>
                        <Icon name="food-apple" size={40} color="#ffffff" />
                        <Text style={Styles.cardText}>Categories</Text>
                    </Ripple>
                </View>


                <View style={{ ...Styles.cardContainer, paddingLeft: 15 }}>
                    <Ripple rippleColor="#ffffff" style={Styles.card} onPress={() => navigation.navigate('SalesOrderForm')}>
                        <Icon name="cart-plus" size={40} color="#ffffff" />
                        <Text style={Styles.cardText}>New Sales</Text>
                    </Ripple>
                </View>
            </View>


            <View style={{ flexDirection: 'row' }}>
                <View style={{ ...Styles.cardContainer, paddingRight: 15 }}>
                    <Ripple rippleColor="#ffffff" style={Styles.card} onPress={() => navigation.navigate('SalesOrders')}>
                        <Icon name="checkbook" size={40} color="#ffffff" />
                        <Text style={Styles.cardText}>Sales Orders</Text>
                    </Ripple>
                </View>


                <View style={{ ...Styles.cardContainer, paddingLeft: 15 }}>
                    <Ripple rippleColor="#ffffff" style={Styles.card}>
                        <Icon name="note-text" size={40} color="#ffffff" />
                        <Text style={Styles.cardText}>Notes</Text>
                    </Ripple>
                </View>
            </View>
        </View>
    </React.Fragment>
);

const Styles = StyleSheet.create({
    cardContainer: {
        width: "50%",
        paddingLeft: 30,
        paddingRight: 30,
        paddingTop: 15,
        paddingBottom: 15,
        justifyContent: "center",
        alignItems: "center",
    },

    card: {
        borderRadius: 10,
        paddingLeft: 10,
        paddingRight: 10,
        paddingTop: 20,
        paddingBottom: 20,
        backgroundColor: APP.CONFIG.COLORS.SECONDARY,
        width: "100%",
        justifyContent: "center",
        alignItems: "center",
    },

    cardText: {
        color: "#ffffff",
        fontSize: 16,
        marginTop: 5,
        fontWeight: "bold",
    },
});