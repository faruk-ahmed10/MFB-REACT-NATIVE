import React, { useEffect, useState } from 'react';
import { View, Text, Button, StyleSheet } from 'react-native';
import { APP } from '../../../../App/Init/AppProvider';

export const Counter = () => {
    const [TodayTotalSalesAmount, setTodayTotalSalesAmount] = useState(0);
    const [SalesTargetAmount, setSalesTargetAmount] = useState(0);
    
    const getTodaySales = () => {
        APP.SERVICES.HTTPRequest.send('get', `/get_today_total_sales_amount`, {}, {}, (data: any) => {
            setTodayTotalSalesAmount(data.data);
        });
    };

    const getSalestargetAmount = () => {
        APP.SERVICES.HTTPRequest.send('get', `/get_sales_target_amount`, {}, {}, (data: any) => {
            setSalesTargetAmount(data.data);
        });
    };

    useEffect(() => {
        getTodaySales();
        getSalestargetAmount();
    });
    
    return (
        <View style={{ flexDirection: 'row' }}>
            <View style={Styles.card}>
                <Text style={Styles.cardValue}>{TodayTotalSalesAmount}</Text>
                <Text style={Styles.cardLabel}>Today's Sales</Text>
            </View>
            <View style={Styles.card}>
                <Text style={Styles.cardValue}>{SalesTargetAmount}</Text>
                <Text style={Styles.cardLabel}>Sales Target</Text>
            </View>
        </View>
    );
};

const Styles = StyleSheet.create({
    card: {
        borderRadius: 2,
        width: "50%",
        alignItems: "center",
        paddingTop: 30,
        paddingBottom: 30,

    },
    cardValue: {
        fontSize: 25,
        color: "#000000",
        fontWeight: "bold",
    },
    cardLabel: {
        fontSize: 17,
        color: "#000000",
        marginTop: 3,
    },
});