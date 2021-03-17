import React from 'react';
import { StatusBar, ToastAndroid } from 'react-native';
import { APP } from '../../../../App/Init/AppProvider';
import { Appbar } from '../../Global/Appbar/Appbar';

const Header = ({ title, subtitle, showBackAction, navigation, showNewOrderAction, showSaveAction, onSavePress }: Partial<{
    title: string,
    subtitle: string,
    showBackAction: boolean | undefined,
    navigation: any,
    showNewOrderAction: boolean | undefined,
    showSaveAction: boolean | undefined,
    onSavePress(): void,
}>) => {
    return (
        <React.Fragment>
            <StatusBar backgroundColor={APP.CONFIG.COLORS.STATUS_BAR} />
            <Appbar>
                {showBackAction && (
                    <Appbar.BackAction color="#ffffff" onPress={() => navigation.goBack()} />
                )}

                {!showBackAction && (
                    <Appbar.Action
                        icon="menu"
                        onPress={() => navigation.toggleDrawer()}
                        color="#ffffff"
                    />
                )}
                <Appbar.Content title={title} subtitle={subtitle} color="#ffffff" />
                {showNewOrderAction && (
                    <Appbar.Action icon="cart-plus" onPress={() => navigation.navigate('SalesOrderForm')} onLongPress={() => {
                        ToastAndroid.show('New Order', ToastAndroid.SHORT);
                    }} color="#ffffff" />
                )}
                
                {showSaveAction && (
                    <Appbar.Action icon="content-save" onPress={onSavePress} onLongPress={() => {
                        ToastAndroid.show('Save', ToastAndroid.SHORT);
                    }} color="#ffffff" />
                )}
            </Appbar>
        </React.Fragment>
    )
};

export { Header };