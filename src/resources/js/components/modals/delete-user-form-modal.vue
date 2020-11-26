<template>
  <div>
    <!-- deleteUser Modal Form -->
    <div class="modal fade" :id="'deleteUser-' + item.id" tabindex="-1" role="dialog" aria-labelledby="changeRoleLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="changeRoleLabel">{{ __('app.confirmation') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- <form class="form-group" :action="item.links.api_detach" method="post"> -->

          <div class="modal-body">

            <form class="form-group" @submit.prevent="submitData()" :action="item.links.api_detach">

              <div class="modal-body">
                {{ __('app.are_you_sure') }}

              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('app.cancel') }}</button>

                <button type="submit" class="btn btn-danger">
                  {{ __('app.yes_i_confirm') }}
                </button>

              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<style>

</style>

<script>
import FormMixin from '../../FormMixin';


export default {
  props: ['item'],
  mixins: [ FormMixin ],
  data() {
    return {
      'action': this.item.links.api_detach,
      'fields': {},
    }
  },
  methods: {
    submitData() {
      this.fields = this.item;
      this.submitPost();
      $('#deleteUser-' + this.item.id).modal('hide');
      this.item.role = null;
    },
  },
  mounted() {
  },


}
</script>
