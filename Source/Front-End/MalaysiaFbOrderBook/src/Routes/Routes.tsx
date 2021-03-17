import React from 'react';
import { connect } from 'react-redux';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import { createDrawerNavigator } from '@react-navigation/drawer';
import Home from '../Screens/Private/Home/Home';
import Login from '../Screens/Public/Login/Login';
import { ServicePreparationSplash } from '../Screens/Global/ServicePreparationSplash/ServicePreparationSplash';
import { Drawer as DrawerContent } from '../Layouts/Components/Private/Drawer/Drawer';
import Profile from '../Screens/Private/Profile/Profile';
import Logout from '../Screens/Private/Logout/Logout';
import Products from '../Screens/Private/Products/Products';
import Categories from '../Screens/Private/Categories/Categories';
import { SalesOrders } from '../Screens/Private/SalesOrders/SalesOrders';
import { SalesOrderForm } from '../Screens/Private/SalesOrders/SalesOrderForm';

const Stack = createStackNavigator();
const Drawer = createDrawerNavigator();


const Routes = ({ auth }: any) => {

    if (auth.isLoggedIn === 'SERVICE_PREPARATION') {
        return <ServicePreparationSplash />;
    }

    return (
        <React.Fragment>
            <NavigationContainer>
                {auth.isLoggedIn === false && (
                    <Stack.Navigator initialRouteName="Login">
                        <Stack.Screen name="Login" options={{ title: "MFB", headerShown: false }} component={Login} />
                    </Stack.Navigator>
                )}

                {auth.isLoggedIn && (
                    <Drawer.Navigator initialRouteName="Home" drawerContent={(props: any) => <DrawerContent {...props} />}>
                        <Drawer.Screen name="Home" component={Home} />
                        <Drawer.Screen name="Profile" component={Profile} />
                        <Drawer.Screen name="Categories" component={Categories} />
                        <Drawer.Screen name="Products" component={Products} />
                        <Drawer.Screen name="SalesOrders" component={SalesOrders} />
                        <Drawer.Screen name="SalesOrderForm" component={SalesOrderForm} />
                        <Drawer.Screen name="Logout" component={Logout} />
                    </Drawer.Navigator>
                )}
            </NavigationContainer>
        </React.Fragment>
    );
};

export default connect((state: any) => {
    return {
        auth: state.AUTH,
    }
})(Routes);