import React from 'react';
import PropTypes from 'prop-types';
import { Button as ButtonP } from 'react-native-paper';

export const Button = ({ label, icon, mode, onPress, style }) => (
    <ButtonP icon={icon} mode={mode} onPress={onPress} style={style}>
        {label}
    </ButtonP>
);

Button.propTypes = {
    label: PropTypes.string.isRequired,
    icon: PropTypes.any,
    onPress: PropTypes.func,
    mode: PropTypes.any,
    style: PropTypes.any,
};