import React from 'react';
import { View, Text } from 'react-native';
import { APP } from '../../../App/Init/AppProvider';

class Logout extends React.Component<any, any> {
    constructor(props: any) {
        super(props);
        this.logout = this.logout.bind(this);
    }


    private logout() {
        APP.SERVICES.HTTPRequest.send('get', '/logout', {}, {}, (data: any) => {
            new APP.SERVICES.AUTH().set({
                isLoggedIn: false,
                token: '',
            });
        }, (error: any) => {
            this.props.navigation.navigate('Home');
        });
    }

    public componentDidMount(): void {
        this.logout();
    }


    render(): any {
        return (
            <React.Fragment>
                <View style={{ flex: 1, justifyContent: "center", alignItems: 'center', }}>
                    <Text>Logging out</Text>
                </View>
            </React.Fragment>
        );
    }
}

export default Logout;
