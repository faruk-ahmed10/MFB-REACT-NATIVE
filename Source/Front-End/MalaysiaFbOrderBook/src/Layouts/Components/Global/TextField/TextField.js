import React from 'react';
import PropTypes from 'prop-types';
import { TextInput } from 'react-native-paper';

export const TextField= ({label, value, onChange, mode, disabled, dense, secureTextEntry, keyboardType, style}) => (
    <TextInput
        label={label}
        value={value}
        onChangeText={onChange}
        mode={mode}
        secureTextEntry={secureTextEntry}
        style={style}
        dense={dense}
        disabled={disabled}
    />
);

TextField.propTypes = {
    label: PropTypes.string.isRequired,
    value: PropTypes.any,
    onChange: PropTypes.func,
    mode: PropTypes.any,
    disabled: PropTypes.bool,
    secureTextEntry: PropTypes.bool,
    dense: PropTypes.bool,
    keyboardType: PropTypes.any,
    style: PropTypes.object,
};