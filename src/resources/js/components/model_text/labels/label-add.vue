<template>
  <div class="">

    <div class="row" v-if="!value">
      <div class="col">

        <label class="typo__label">
          {{ __('app.add_new_label') }}
        </label>

        <multiselect
        v-model="value"
        deselect-label="Can't remove this value"
        track-by="name"
        label="name"
        placeholder="Select one"
        :options="options"
        :searchable="false"
        :allow-empty="false">
        <template
        slot="singleLabel"
        slot-scope="{ option }">
        {{ option.name }}
      </template>
    </multiselect>


  </div>

  <div class="col">

    <label>
      {{ __('app.label') }} <em class="small">{{ __('app.default_description') }}</em>
    </label>

    <div v-if="value">
      {{ value.default_description }}
    </div>

  </div>
</div>

<div class="row" v-else>
  <div class="col">

    <label>
      {{ __('app.label') }}
      <em class="small">{{ __('app.name') }}</em>
    </label>

    <div v-if="value">
      <input type="text"
      v-model="value.name"
      placeholder="name"
      class="form-control">
    </div>
  </div>

  <div class="col">

    <label>
      {{ __('app.attribute') }}
      <em class="small">{{ __('app.' + value.format ) }}</em>
    </label>

    <input v-if="value.format === 'string'"
    type="text"
    v-model="value.attribute"
    class="form-control">

    <input v-if="value.format === 'int'"
    type="number"
    v-model="value.attribute"
    class="form-control">

    <input v-if="value.format === 'datetime'"
    type="date"
    v-model="value.attribute"
    class="form-control">

    <div class="row">
      <div class="col">

      </div>
      <div class="col ml-auto text-right">

        <button
        type="button"
        @click="value = null"
        class="btn btn-secondary btn-sm"
        >
        <fa icon="times"></fa>
        {{ __('app.cancel') }}
      </button>

      <button
      type="button"
      @click="saveLabels"
      class="btn btn-sm btn-success"
      >
      <fa icon="save"></fa>
      {{ __('app.save') }}
    </button>
  </div>

</div>



</div>
</div>

</div>

</template>

<script>
import Multiselect from 'vue-multiselect';
import FormMixin from '../../../FormMixin';

// register globally
// Vue.component('multiselect', Multiselect)

export default {
  props: ['page_url', 'labels', 'text'],
  components: { Multiselect },
  mixins: [ FormMixin ],

  created() {
    this.fetchData(this.page_url);
  },
  data () {
    return {
      value: null,
      options: [],
      error: null,
      errors: {},
      success: false,
      loaded: true,
    }
  },
  methods: {
    saveLabels() {
      this.action = this.text.links.api_label_store;
      this.fields = this.value;
      this.submitPost();
      this.$emit('reload-data');
      window.location.href = this.text.links.self;
    },
    fetchData(page_url){
      axios.get(page_url)
      .then((response) =>{
        if(response.status == 200){
          this.options = response.data.data;
        }
      }).catch(err=>{
        console.log(err)
      });
    },
  }

}
</script>


<!--
Add Multiselect CSS. Can be added as a static asset or inside a component.
-->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>
</style>
