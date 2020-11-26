export default {
  data() {
    return {
      edit: false,
      add_new: false,
      fields: {},
      error: null,
      errors: {},
      success: false,
      loaded: true,
      action: '',
      response_payload: '',
      data_fetched: false,
    }
  },

  methods: {
    beforeAction() {
      this.loaded = false;
      this.success = false;
      this.errors = {};
    },
    afterAction(response) {
      if(response.status == 200){
        this.response_payload = response.data;
        this.$emit('reload-data');
        this.data_fetched = true;
      }
      // this.fields = {}; //Clear input fields.
      this.loaded = true;
      this.success = true;
      this.edit = false;
      setTimeout(() => {
        this.success = false;
      }, 1500);
    },
    submitPatch() {
      if (this.loaded) {
        this.beforeAction();
        axios.patch(this.action, this.fields)
        .then(response => {
          this.afterAction(response);
        }).catch(error => {
          this.loaded = true;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
          else {
            this.error = error.response.data;
          }
        });
      }
    },
    submitDelete() {
      if (this.loaded) {
        this.beforeAction();
        axios.delete(this.action, this.fields)
        .then(response => {
          this.afterAction(response);
        }).catch(error => {
          this.loaded = true;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
          else {
            this.error = error.response.data;
          }
        });
      }
    },
    submitPost() {
      if (this.loaded) {
        this.beforeAction();
        axios.post(this.action, this.fields)
        .then(response => {
          this.afterAction(response);
        }).catch(error => {
          this.loaded = true;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
          else {
            this.error = error.response.data;
          }
        });
      }
    },
  },
}
