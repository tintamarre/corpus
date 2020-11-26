<template>

  <!-- Modal -->
  <div class="modal fade" id="TextLabelModal" tabindex="-1" role="dialog" aria-labelledby="TextLabelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="TextLabelModalLabel">{{ __('app.edit_labels') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <table class="table table-sm table-borderless">
            <thead>
              <tr>
                <th>{{ __('app.name') }}</th>
                <th>{{ __('app.attribute') }}</th>
                <th>{{ __('app.action') }}</th>
              </tr>
            </thead>

            <tbody v-for="(label, index) in labels">
              <label-attribute
              :label="label"
              :labels="labels"
              :index="index" />
            </tbody>

          </table>

          <new-label-form :labels="labels" :text="text" />

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">
            <fa icon="times"></fa>
            {{ __('app.close') }}
          </button>
        </div>
      </div>
    </div>
  </div>

</template>

<style>

</style>

<script>

import FormMixin from '../../../FormMixin';

export default {
  mixins: [ FormMixin ],
  props: ['labels', 'links', 'text'],

  mounted() {
  },
  data() {
    return {
      // 'action': labels.links.api_label_update,

    }
  },

}
</script>
