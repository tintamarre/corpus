<template>
  <div>
    <div v-if="confirmDelete">


      <div class="modal-body">
        {{ __('app.are_you_sure') }}


      </div>

      <div class="modal-footer">
        <button type="button"
        class="btn btn-sm btn-secondary"
        @click="confirmDelete = !confirmDelete">
        <fa icon="times"></fa> {{ __('app.cancel') }}
      </button>

      <button
      @click="deleteCollection"
      class="btn btn-sm btn-danger">
      <fa icon="trash"></fa>
      {{ __('app.yes_i_confirm') }}
    </button>

  </div>

</div>
<button type="button"
name="button"
class="btn btn-sm btn-danger"
v-if="!confirmDelete"
@click="confirmDelete = !confirmDelete">
<fa icon="trash"></fa>
{{ __('app.delete') }} {{ __('app.collection') }}
</button>

</div>
</template>

<style>

</style>

<script>
import FormMixin from '../../FormMixin';
import GetDataMixin from '../../GetDataMixin';

export default {
  props: ['page_url'],
  mixins: [ FormMixin, GetDataMixin],

  mounted() {
  },
  data() {
    return {
      confirmDelete: false,

    }
  },
  methods: {
    deleteCollection() {
      this.action = this.fields.links.api_destroy;
      this.fields = this.fields;
      this.submitDelete();
      window.location.href = "/portfolio";
    }
  }
}
</script>
