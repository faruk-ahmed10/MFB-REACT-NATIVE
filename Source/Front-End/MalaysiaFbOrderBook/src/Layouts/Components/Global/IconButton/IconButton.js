import React from 'react';
import PropTypes from 'prop-types';
import { IconButton as IconButtonP } from 'react-native-paper';

export const IconButton = ({size, icon, color, style, onPress}) => (
    <IconButtonP size={size} icon={icon} color={color} style={style} onPress={onPress} animated={true} />
);

IconButton.propTypes = {
    size: PropTypes.any,
    icon: PropTypes.string,
    color: PropTypes.string,
    style: PropTypes.object,
    onPress: PropTypes.func,
};