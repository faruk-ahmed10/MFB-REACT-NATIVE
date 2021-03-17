import React from 'react';
import { View, Text } from 'react-native';
import { ListItem } from '../../Global/List/List';

import { APP } from '../../../../App/Init/AppProvider';
import { Avatar, AvatarImage } from '../../Avatar/Avatar';
import { IconButton } from '../../Global/IconButton/IconButton';

export class DrawerItems extends React.Component<any, any> {
    public state: any;

    public constructor(props: any) {
        super(props);

        this.state = {
			id: '',
			FullName: '',
            Email: '',
            ProfileImageUrl: '',
        };
    }

    private getUserProfile() {
        APP.SERVICES.HTTPRequest.send('get', '/sess_user', {}, {}, (data: any) => {
            const responseData = data.data;

            this.setState({
                id: responseData.id,
                FullName: responseData.name,
                Email: responseData.email,
            });
        });
    }

    public componentDidMount(): void {
        this.getUserProfile();
    }

    render(): React.ReactChild {
        return (
            <React.Fragment>
                <View style={{ paddingTop: 50, paddingLeft: 30, paddingBottom: 50, backgroundColor: APP.CONFIG.COLORS.PRIMARY }}>
                    {(this.state.ProfileImageUrl !== '' && this.state.ProfileImageUrl !== null) ? (
                        <AvatarImage size={60} source={this.state.ProfileImageUrl} onPress={() => this.props.navigation.navigate('Profile')} />
                    ) : (
                            <IconButton size={35} icon="account" color="#000000" style={{ backgroundColor: "#eeeeee" }} onPress={() => this.props.navigation.navigate('Profile')} />
                        )}

                    <View style={{ marginTop: 10 }}>
                        <Text style={{ color: "#ffffff", fontWeight: "bold", fontSize: 13, }}>ID: {this.state.id}</Text>
                        <Text style={{ color: "#ffffff", fontWeight: "bold", fontSize: 13, }}>{this.state.FullName}</Text>
                        <Text style={{ color: "#ffffff", fontSize: 13, }}>({this.state.Email})</Text>
                    </View>
                </View>
                <ListItem
                    icon="home"
                    title={"Home"}
                    onPress={() => this.props.navigation.navigate('Home')}
                />
                <ListItem
                    icon="food-apple"
                    title={"Categories"}
                    onPress={() => this.props.navigation.navigate('Categories')}
                />
                <ListItem
                    icon="cart-plus"
                    title={"New Order"}
                    onPress={() => this.props.navigation.navigate('SalesOrderForm')}
                />
                <ListItem
                    icon="checkbook"
                    title={"Sales Orders"}
                    onPress={() => this.props.navigation.navigate('SalesOrders')}
                />
                <ListItem
                    icon="exit-to-app"
                    title={"Logout"}
                    onPress={() => this.props.navigation.navigate('Logout')}
                />
            </React.Fragment>
        )
    }
}


export const Drawer = (props: any) => {
    return (
        <React.Fragment>
            <View>
                <DrawerItems navigation={props.navigation} />
            </View>
        </React.Fragment>
    )
}