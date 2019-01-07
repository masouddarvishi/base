import React, { Component } from "react";

import IconButton from '@material-ui/core/IconButton';
import MUIButton from '@material-ui/core/Button';

import { Icon } from "../";

export default class Button extends Component{
    
    render(){
        let icon = this.props.icon ? <Icon icon={this.props.icon} /> : null;

        switch (this.props.type) {
            case 'icon':
                return(
                    <IconButton className={this.props.className} aria-label="Delete" color="primary">
                        { icon }
                    </IconButton>
                );
            default:
                return(
                    <MUIButton
                        variant={this.props.type}
                        href={this.props.href}
                        color="primary"
                        className={this.props.className}
                    >
                        { icon } { this.props.label }
                    </MUIButton>
                );
        }
        
    }
}