import React from 'react';
import PropTypes from 'prop-types';
import { StyleSheet, View } from 'react-native';
import TextTicker from 'react-native-text-ticker';

const MarqueeText = ({ containerStyle, textStyle, text }) => {
    return (
        <View style={{...styles.container, ...containerStyle}}>
            <TextTicker
                style={textStyle}
                duration={10000}
                loop
                bounce
                repeatSpacer={40}
                marqueeDelay={1000}>
                {text}
            </TextTicker>
        </View>
    );
};

const styles = StyleSheet.create({
    container: {
        justifyContent: 'center',
        alignItems: 'center',
    },
});

MarqueeText.propTypes = {
    containerStyle: PropTypes.object,
    textStyle: PropTypes.object,
    text: PropTypes.string.isRequired,
};

export { MarqueeText };