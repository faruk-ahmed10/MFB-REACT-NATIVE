import React from 'react';
import { ScrollView, View, Text } from 'react-native';
import { APP } from '../../../App/Init/AppProvider';
import { ListItem } from '../../../Layouts/Components/Global/List/List';
import { Header } from '../../../Layouts/Components/Private/Header/Header';

class Categories extends React.Component<any, any> {
    public state: any;

    public constructor(props: any) {
        super(props);

        this.state = {
            Categories: [],
        };

        this.getCategories = this.getCategories.bind(this);
    }

    protected getCategories() {
        APP.SERVICES.HTTPRequest.send('get', '/categories', {}, {}, (data: any) => {
            this.setState({ Categories: data.data });
        });
    }

    public componentDidMount(): void {
        this.getCategories();
    }

    public render(): any {
        return (
            <React.Fragment>
                <Header
                    navigation={this.props.navigation} title={"Categories"}
                    showBackAction={true}
                    showNewOrderAction={true} />
                <ScrollView>
                    {this.state.Categories.map((Category: any, index: number) => (
                        <ListItem key={index} title={Category.name} icon="chevron-right" onPress={() => {
                            this.props.navigation.navigate("Products", {
                                categoryId: Category.id,
                                categoryName: Category.name,
                            });
                        }} />
                    ))}
                </ScrollView>
            </React.Fragment>
        );
    }
}

export default Categories;