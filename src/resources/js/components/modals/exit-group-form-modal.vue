<template>
  <div>
    <!-- Exit Modal Form -->
    <div class="modal fade" :id="'exitModal-' + item.id" tabindex="-1" role="dialog" aria-labelledby="exitModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exitModalLabel">{{ __('app.confirmation') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-group" :action="item.links.api_detach + '?api_token=' + apiToken" method="post">

            <div class="modal-body">
              {{ __('app.are_you_sure') }}

              <input type="hidden" name="_token" id="csrf-token" :value="csrfToken" />
              <input type="hidden" name="collection_id" :value="item.collection_id">
              <input type="hidden" name="id" :value="item.id">

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
</template>

<style>

</style>

<script>

export default {
  props: ['item'],
  methods: {
  },
  mounted() {
    this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    this.apiToken = document.querySelector('meta[name="api-token"]').content
  },
  data() {
    return {
      csrfToken: "",
      apiToken: "",

    }
  },

}
</script>
