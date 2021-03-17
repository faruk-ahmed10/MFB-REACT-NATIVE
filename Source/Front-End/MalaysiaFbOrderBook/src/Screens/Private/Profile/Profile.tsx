import React from 'react';
import { View, Text, Button } from 'react-native';
import { APP } from '../../../App/Init/AppProvider';
import { Avatar } from '../../../Layouts/Components/Avatar/Avatar';
import { ListItem } from '../../../Layouts/Components/Global/List/List';
import { Header } from '../../../Layouts/Components/Private/Header/Header';

class Profile extends React.Component<any, any> {
    public state: any;

    constructor(props: any) {
        super(props);

        this.state = {
            UserType: '',
            FullName: '',
            Email: '',
            Phone: '',
            CurrentTargetMonth: '',
            CurrentTargetYear: '',
            CurrentTargetAmount: 0,
        };

        this.getUserProfile = this.getUserProfile.bind(this);
    }


    private getUserProfile() {
        APP.SERVICES.HTTPRequest.send('get', '/sess_user', {}, {}, (data: any) => {
            const responseData = data.data;

            this.setState({
                UserType: responseData.type,
                FullName: responseData.name,
                Email: responseData.email,
                Phone: responseData.phone,
                CurrentTargetMonth: responseData.current_sales_target.month,
                CurrentTargetYear: responseData.current_sales_target.year,
                CurrentTargetAmount: responseData.current_sales_target.amount,
            });
        });
    }

    public componentDidMount(): void {
        this.getUserProfile();
    }


    render(): any {
        return (
            <React.Fragment>
                <Header title={"Profile"} showBackAction={true} navigation={this.props.navigation} />

                <View style={{ paddingTop: 25, paddingBottom: 25, backgroundColor: "#eeeeee", alignContent: "center", alignItems: 'center', }}>
                    <Avatar icon="account" size={70} />
                    <Text style={{ marginTop: 20, fontSize: 20 }}>
                        {this.state.FullName}
                    </Text>

                    <Text style={{ marginTop: 0, fontSize: 15 }}>
                        Target: {!APP.FUNCTIONS.IS_NULL_OR_UNDEFINED(this.state.CurrentTargetAmount) ? this.state.CurrentTargetAmount : ''}

                        {(!APP.FUNCTIONS.IS_NULL_OR_UNDEFINED(this.state.CurrentTargetMonth) && !APP.FUNCTIONS.IS_NULL_OR_UNDEFINED(this.state.CurrentTargetYear)) && (
                            <>
                                &nbsp;({this.state.CurrentTargetMonth}, {this.state.CurrentTargetYear})
                            </>
                        )}
                    </Text>
                </View>



                {!APP.FUNCTIONS.IS_NULL_OR_UNDEFINED(this.state.UserType) && (
                    <ListItem
                        icon="account-question"
                        title={this.state.UserType}
                    />
                )}


                {!APP.FUNCTIONS.IS_NULL_OR_UNDEFINED(this.state.Email) && (
                    <ListItem
                        icon="email"
                        title={this.state.Email}
                    />
                )}

                {!APP.FUNCTIONS.IS_NULL_OR_UNDEFINED(this.state.Phone) && (
                    <ListItem
                        icon="phone"
                        title={this.state.Phone}
                    />
                )}
            </React.Fragment>
        );
    }
}

export default Profile;
