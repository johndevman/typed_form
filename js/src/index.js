'use strict';

import React from 'react'
import { render } from 'react-dom';
import TypedForm from './TypedForm';

document.addEventListener("DOMContentLoaded", function() {
  const roots = document.querySelectorAll('.typed-form');
  if (roots) {
    roots.forEach(function(root) {

      const schema = root.getAttribute('data-schema');
      const uiSchema = root.getAttribute('data-ui-schema');

      render((
        <TypedForm
          schema={schema}
          uiSchema={uiSchema}
        />
      ), root);
    });
  }
});
