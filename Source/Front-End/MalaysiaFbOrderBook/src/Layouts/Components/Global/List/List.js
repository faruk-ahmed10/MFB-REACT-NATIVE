import React from 'react';
import PropTypes from 'prop-types';
import { List } from 'react-native-paper';

export const ListItem = ({ title, description, disabled, icon, onPress, onLongPress }) => {
    return (
        <List.Item
            title={title}
            description={description}
            disabled={disabled}
            onPress={onPress}
            onLongPress={onLongPress}
            {...(icon !== null && icon !== '' && typeof icon !== 'undefined') ? { left: (props) => <List.Icon {...props} icon={icon} /> } : null}
            titleStyle={{fontSize: 17}}
        />
    )
};

ListItem.propTypes = {
    title: PropTypes.string.isRequired,
    description: PropTypes.string,
    icon: PropTypes.string,
    disabled: PropTypes.bool,
    onPress: PropTypes.func,
    onLongPress: PropTypes.func,
};
