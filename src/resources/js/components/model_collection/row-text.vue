<template>
<tr>


    <td>
      <a :href="text.links.self"><fa icon="file"></fa> {{ text.name }}</a>
    </td>
    <td class="text-right"
    v-tooltip:top="text.relationships.stats.reading_estimate.trans + ': ' + text.relationships.stats.reading_estimate.value">{{ text.relationships.stats.number_of_chars.value }}</td>
    <td>
      <labels-div :labels="text.relationships.labels"></labels-div>
    </td>
    <td class="text-right">
      {{ text.relationships.tagscloud.length }}
    </td>
    <td>{{ text.relationships.uploader.name }}</td>
    <td class="text-muted small">
      {{ text.datetimes.updated_at_diff }}
    </td>
    <td class="">
      <div v-if="text.relationships.uploader.is_auth"
      >

      <button
      v-if="!confirmationDelete"
      @click="confirmationDelete = !confirmationDelete"
      class="btn btn-sm"
      >
      <fa icon="trash" />
    </button>
    <div v-if="confirmationDelete"
    >
    <button
    class="btn btn-sm btn-secondary"
    @click="confirmationDelete = !confirmationDelete"
      >
    <fa icon="times" /> {{ __('app.cancel') }}
  </button>
  <button
  v-if="text.relationships.uploader.is_auth"
  @click="deleteText()"
  class="btn btn-sm btn-danger"
  v-tooltip:top="__('app.delete')">
  <fa icon="trash" /> {{ __('app.yes_i_confirm') }}
</button>
</div>

</div>
</td>
</tr>
</template>

<style>

</style>

<script>

import FormMixin from '../../FormMixin';

export default {
  props: ['text'],
  mixins: [ FormMixin ],

  mounted() {
  },
  data() {
    return {
      confirmationDelete: false
    }
  },
  methods: {
    deleteText() {
      this.action = this.text.links.api_destroy;
      this.submitDelete();
      location.reload();
    }

  }
}
</script>
