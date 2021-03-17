import React from 'react';
import { View, Text, Alert, Image } from 'react-native';
import { APP } from '../../../App/Init/AppProvider';
import { TextField } from '../../../Layouts/Components/Global/TextField/TextField';
import { Button } from '../../../Layouts/Components/Global/Button/Button';

class Login extends React.Component<any, any> {
    constructor(props: any) {
        super(props);

        this.state = {
            Email: '',
            Password: '',
            token: '',
        };

        this.handleTryLogin = this.handleTryLogin.bind(this);
    }

    protected handleTryLogin(): void {
        if (this.state.Email.toString().trim() === '') {
            Alert.alert('Error', 'Please enter your email address!');
            return;
        } else if (this.state.Password === '') {
            Alert.alert('Error', 'Please enter your password!');
            return;
        }

        APP.SERVICES.HTTPRequest.send('post', '/login', {}, {
            email: this.state.Email,
            password: this.state.Password,
        }, (data: any) => {
            new APP.SERVICES.AUTH().set({
                isLoggedIn: true,
                token: data.token,
            });
        });
    }

    render(): React.ReactChild {
        return (
            <React.Fragment>
                <View style={{ flex: 1, backgroundColor: "#ffffff", justifyContent: "center" }}>
                    <View style={{ marginLeft: 30, marginRight: 30 }}>
                        <Text style={{ fontSize: 16, textAlign: "center"}}>Welcome</Text>
                        <Text style={{ fontSize: 20, textAlign: "center", fontWeight: "bold", marginBottom: 40 }}>
                            Malaysia Food & Beverage Industry
                        </Text>

                        <Image source={{uri: "./Logo.png"}} style={{ width: '100%', }}/>

                        <TextField
                            label={"Email"}
                            value={this.state.Email}
                            onChange={(value: any) => this.setState({
                                Email: value,
                            })}
                            mode="outlined"
                            style={{ marginBottom: 20 }}
                        />
                        <TextField
                            label={"Password"}
                            value={this.state.Password}
                            onChange={(value: any) => this.setState({
                                Password: value,
                            })}
                            mode={"outlined"}
                            secureTextEntry={true}
                            style={{ marginBottom: 20 }}
                        />

                        <Button
                            label={"Login"}
                            icon={"login"}
                            mode={"contained"}
                            onPress={this.handleTryLogin}
                        />
                    </View>
                </View>
            </React.Fragment>
        );
    }
}

export default Login;
