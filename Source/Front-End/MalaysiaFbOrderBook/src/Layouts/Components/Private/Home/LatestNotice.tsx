import React from 'react';
import { View } from 'react-native';
import { APP } from '../../../../App/Init/AppProvider';
import { MarqueeText } from '../../Global/MarqueeText/MarqueeText';

export class LatestNotice extends React.Component<any, any> {
    public state: any;

    public constructor(props: any) {
        super(props);

        this.state = {
            NoticeText: '',
        };

        this.getLatestNotice = this.getLatestNotice.bind(this);
    }

    protected getLatestNotice() {
        APP.SERVICES.HTTPRequest.send('get', '/latest_notice', {}, {}, (data: any) => {
            this.setState({ NoticeText: data.data.notice });
        });
    }

    public componentDidMount(): void {
        this.getLatestNotice();
    }

    public render(): any {
        return (
            <React.Fragment>
                {!APP.FUNCTIONS.IS_NULL_OR_UNDEFINED(this.state.NoticeText) && (
                    <MarqueeText containerStyle={{
                        paddingTop: 5, paddingLeft: 10, paddingRight: 10, paddingBottom: 5,
                        backgroundColor: APP.CONFIG.COLORS.SECONDARY, elevation: 5
                    }}
                        textStyle={{ fontSize: 17, color: "#ffffff", fontWeight: "bold", letterSpacing: 1 }}
                        text={this.state.NoticeText} />
                )}
            </React.Fragment>
        );
    }
}