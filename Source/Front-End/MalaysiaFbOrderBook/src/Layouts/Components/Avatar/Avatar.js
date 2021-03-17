import React from 'react';
import PropTypes from 'prop-types';
import { Avatar as AvatarP } from 'react-native-paper';

export const Avatar = ({size, icon, color, style}) => (
    <AvatarP.Icon size={size} icon={icon} color={color} style={style} />
);

export const AvatarImage = ({size, source, style}) => (
    <AvatarP.Image size={size} source={{
        uri: source,
    }} style={style} />
);

Avatar.propTypes = {
    size: PropTypes.any,
    icon: PropTypes.string,
    color: PropTypes.string,
    style: PropTypes.object,
};

AvatarImage.propTypes = {
    size: PropTypes.any,
    source: PropTypes.string,
    style: PropTypes.object,
};