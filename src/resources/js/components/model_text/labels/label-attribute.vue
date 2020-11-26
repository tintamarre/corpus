<template>
  <tr>
    <td>
      <a :href="label.links.self" class="badge badge-primary">
        <fa icon="layer-group"></fa>
        {{ label.name }}
      </a>
    </td>
    <td>
      <div v-if="!edit">
        <span class="badge badge-pill badge-success">
          {{ label.attribute }}
        </span>
      </div>

      <div v-else>

        <input
        v-if="label.format === 'datetime'"
        type="date"
        name="attribute"
        v-model="label.attribute"
        class="form-control" />

        <input
        v-if="label.format === 'int'"
        type="text"
        name="attribute"
        pattern="\d*"
        v-model="label.attribute"
        class="form-control" />

        <input
        v-if="label.format === 'string'"
        type="text"
        name="attribute"
        v-model="label.attribute"
        class="form-control" />

      </div>
    </td>

    <td>

      <div v-if="!edit">
        <button class="btn btn-primary btn-sm" @click="edit = !edit">
          <fa icon="edit"></fa> {{ __('app.edit') }}
        </button>
        <button class="btn btn-danger btn-sm" :alt="__('app.delete')" @click="deleteItem" >
          <fa icon="trash-alt"></fa>
        </button>
      </div>

      <div v-else>
        <button class="btn btn-secondary btn-sm" @click="edit = !edit">
          <fa icon="times"></fa>
          {{ __('app.cancel') }}
        </button>
        <button class="btn btn-success btn-sm" @click="saveItem">
          <fa icon="save"></fa>
          {{ __('app.save') }}
        </button>


      </div>

    </td>
  </tr>
</template>

<script>
import FormMixin from '../../../FormMixin';

export default {
  props: ['label', 'labels', 'index'],
  mixins: [ FormMixin ],

  mounted() {
  },
  data() {
    return {
      'edit': null,
      'action': '',
    }
  },
  methods: {
    deleteItem() {
      this.action = this.label.links.api_destroy;
      this.fields = this.label;
      this.submitDelete();
      this.labels.splice(this.index ,1); //
    },
    saveItem() {
      this.action = this.label.links.api_update;
      this.fields = this.label;
      this.submitPatch();
      // this.label = this.response_payload;
      this.edit = false;
    }
  }

}
</script>
