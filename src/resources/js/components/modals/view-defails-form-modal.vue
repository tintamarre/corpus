<template>
  <div>
    <!-- Exit Modal Form -->
    <div class="modal fade" :id="'viewDetails-' + item.id" tabindex="-1" role="dialog" aria-labelledby="viewDetails" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="viewDetails">{{ __('app.user_details') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <table class="table table-borderless">
              <tr>
                <th class="text-right">{{ __('app.name') }}</th>
                <td>{{ item.name }}</td>
              </tr>
              <tr>
                <th class="text-right">{{ __('app.email') }}</th>
                <td><samp>{{ item.email }}</samp></td>
              </tr>
              <tr>
                <th class="text-right">{{ __('app.role') }}</th>
                <td class="text-muted">{{ item.role }}</td>
              </tr>
              <tr>
                <th class="text-right">{{ __('app.member_since') }}</th>
                <td>{{ item.member_since }}</td>
              </tr>
            </table>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('app.okay') }}</button>

          </div>

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

  // data() {
  //   return {
  //   }
  // },

}
</script>
