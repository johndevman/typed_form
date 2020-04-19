Vue.component('ui-string', {
  props: ['name'],
  template: '<input type="text" :name="name">'
});

Vue.component('typedform', {
  props: ['schema', 'ui_schema'],
  template: `<div>{{ schema }} <component v-for="(component, name) in ui_schema" :is="component.type" :name="name"></component></div>`,
  data: function() {
    return {
      schema: null,
      ui_schema: null,
    }
  },
  mounted: function () {
    this.schema = JSON.parse(this.props.schema);
    this.ui_schema = JSON.parse(this.props.ui_schema);
  }
});

const typed_form = new Vue({
  el: '.typed-form',
  data: {
  }
});
