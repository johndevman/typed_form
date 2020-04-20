'use strict';

import React from 'react';
import StringWidget from './StringWidget';

class TypedForm extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
    };
  }

  componentDidMount() {
  }

  render() {
    return (
      <div>
        <StringWidget />
      </div>
    );
  }

}

export default TypedForm;
