<template>
  <div>
    <!-- ChangeRole Modal Form -->
    <div class="modal fade" :id="'changeRole-' + item.id" tabindex="-1" role="dialog" aria-labelledby="changeRoleLabel" aria-hidden="true">
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


            <table class="table table-borderless">
              <tr class="text-center">
                <td v-if="trigu_role === item.role">
                  {{ item.name }} {{ __('app.is_now') }} {{ trigu_role }}
                </td>
                <td v-else>
                  {{ item.name }} {{ __('app.will_become') }} <strong>{{ trigu_role }}</strong>
                </td>
              </tr>
            </table>

            <div class="modal-footer">
              <div v-if="trigu_role === item.role">

                <button
                type="button"
                name="button"
                class="btn btn-primary"
                @click="changeRole()"
                >
                <fa icon="users-cog"></fa>

                <span v-if="trigu_role != 'admin'">
                  {{ __('app.change_to') }} {{ __('app.admin').toLowerCase() }}
                </span>
                <span v-if="trigu_role != 'member'">
                  {{ __('app.change_to') }} {{ __('app.member').toLowerCase() }}
                </span>
              </button>
            </div>

            <div v-if="trigu_role != item.role">

              <form @submit.prevent="submitData">

                <button type="button"
                class="btn btn-outline-secondary"
                data-dismiss="modal">
                {{ __('app.cancel') }}
              </button>

                <button type="submit" class="btn btn-success">
                  <fa icon="users-cog"></fa> {{ __('app.yes_i_confirm') }}
                </button>
              </form>
            </div>
          </div>

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
  methods: {
    changeRole: function() {
      if(this.trigu_role === 'admin') {
        this.trigu_role = 'member';
      } else
      {
        this.trigu_role = 'admin';
      }
    },
    submitData() {
      this.item.role = this.trigu_role;
      this.fields = this.item;
      this.submitPatch();
      $('#changeRole-' + this.item.id).modal('hide');
    },

  },
  mounted() {
  },
  data() {
    return {
      'fields': {},
      'trigu_role': this.item.role,
      'action': this.item.links.api_update,
    }
  },

}
</script>
