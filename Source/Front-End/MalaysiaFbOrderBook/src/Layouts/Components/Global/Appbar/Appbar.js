import React from 'react';
import { Appbar as AppbarP } from 'react-native-paper';

export const Appbar = ({ children, ...props }) => (
    <AppbarP {...props}>
        {children}
    </AppbarP>
);

Appbar.Action = (props) => (
    <AppbarP.Action {...props} />
);

Appbar.Content = (props) => (
    <AppbarP.Content {...props} />
);

Appbar.BackAction = (props) => (
    <AppbarP.BackAction {...props} />
);