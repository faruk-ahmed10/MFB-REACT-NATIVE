import React from 'react';
import { View, Text, Button, ScrollView } from 'react-native';
import { APP } from '../../../App/Init/AppProvider';
import { MarqueeText } from '../../../Layouts/Components/Global/MarqueeText/MarqueeText';
import { Header } from '../../../Layouts/Components/Private/Header/Header';
import { Counter } from '../../../Layouts/Components/Private/Home/Counter';
import { LatestNotice } from '../../../Layouts/Components/Private/Home/LatestNotice';
import { QuickButtons } from '../../../Layouts/Components/Private/Home/QuickButtons';

const Home = ({ route, navigation }: any) => {
    return (
        <React.Fragment>
            <Header navigation={navigation} title={"Order Book"} showNewOrderAction={true} />
            <LatestNotice />
            
            <ScrollView>

                <Counter />
                <QuickButtons navigation={navigation} />
            </ScrollView>
        </React.Fragment >
    );
};


export default Home;
