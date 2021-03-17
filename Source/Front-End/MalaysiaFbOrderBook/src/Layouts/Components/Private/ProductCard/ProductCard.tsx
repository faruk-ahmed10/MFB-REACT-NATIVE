import React from 'react';
import { View, Text, Image, FlatList, StatusBar, SafeAreaView, ScrollView, StyleSheet, TouchableOpacity } from 'react-native';
import Ripple from 'react-native-material-ripple';
import { APP } from '../../../../App/Init/AppProvider';

const ProductCard = ({ data, onPress, style }: any) => {
    return (
        <Ripple rippleColor="#ffffff" onPress={onPress} style={{ flex: 1, aspectRatio: 1, margin: 10 }} >
            <Image source={{ uri: APP.CONFIG.API.IMAGE_CDN_ROOT + "/products/" + data.image }} style={Styles.image} resizeMode='cover' />
            <View style={Styles.captionContainer}>
                <Text style={Styles.captionTitle}>{data.name}</Text>
            </View>

            <View style={Styles.priceContainer}>
                <Text style={Styles.priceTitle}>{data.price}</Text>
            </View>
        </Ripple>
    )
};

const Styles = StyleSheet.create({
    image: {
        flex: 1,
        borderRadius: 5,
    },

    captionContainer: {
        position: "absolute",
        bottom: 0,
        left: 0,
        right: 0,
        backgroundColor: "#000000",
        opacity: 0.7,
        paddingTop: 5,
        paddingLeft: 5,
        paddingRight: 5,
        paddingBottom: 5,
        borderBottomLeftRadius: 5,
        borderBottomRightRadius: 5,
    },
    captionTitle: {
        color: "#ffffff",
        fontSize: 16,
        fontWeight: "bold",
    },

    priceContainer: {
        position: "absolute",
        top: 0,
        right: 0,
        backgroundColor: APP.CONFIG.COLORS.SECONDARY,
        opacity: 0.7,
        paddingTop: 5,
        paddingLeft: 5,
        paddingRight: 5,
        paddingBottom: 5,
        borderBottomLeftRadius: 5,
    },
    priceTitle: {
        color: "#ffffff",
        fontSize: 14,
        fontWeight: "bold",
    },
});

export { ProductCard };