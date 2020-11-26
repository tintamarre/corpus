<template>
  <div id="users">
    <h2>{{ __('app.members') }}
      <small>{{ users.length }}</small>
    </h2>
    <div class="">
      {{ message }}
    </div>
    <div>
      <table class="table table-sm table-border">
        <tr v-for="(item, index) in users"
        :key="item.index" v-if="item.role != null">
        <th class="text-right">
          <span v-if="item.is_auth">
            <fa icon="user" class="text-muted"></fa>
          </span>
          {{ item.name }}
        </th>
        <td class="small">
          {{ __('app.' + item.role) }}

        </td>

        <td>
          <div class="dropdown">
            <button class="btn btn-sm dropdown-toggle"
            type="button"
            id="dropdown"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
          </button>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown">

            <button
            v-if="!item.is_auth && authIsAdmin()"
            class="dropdown-item"
            type="button"
            data-toggle="modal"
            :data-target="'#deleteUser-' + item.id">
            <fa icon="user-minus"></fa>
            {{ __('app.remove') }}
          </button>

          <div v-if=authIsAdmin()>
            <button
            class="dropdown-item"
            type="button"
            v-if="item.role != 'member' && allowDeleteAdmin()"
            data-toggle="modal"
            :data-target="'#changeRole-' + item.id">
            <fa icon="users-cog"></fa>
            {{ __('app.make_member') }}
          </button>

          <button
          class="dropdown-item"
          type="button"
          v-if="item.role != 'admin'"
          data-toggle="modal"
          :data-target="'#changeRole-' + item.id">
          <fa icon="users-cog"></fa>
          {{ __('app.make_admin') }}


        </button>
      </div>

      <!-- Button trigger modal -->
      <button v-if="allowExit(item)"
      class="dropdown-item"
      type="button"
      data-toggle="modal"
      :data-target="'#exitModal-' + item.id">
      <fa icon="sign-out-alt"></fa>
      {{ __('app.exit_group') }}
    </button>
    <!-- Button trigger modal -->
    <button
    class="dropdown-item"
    type="button"
    data-toggle="modal"
    :data-target="'#viewDetails-' + item.id">
    <fa icon="user"></fa>
    {{ __('app.view_details') }}
  </button>


</div>
</div>

<exit-group-form-modal v-if="item.is_auth" :item="item">
</exit-group-form-modal>

<view-defails-form-modal :item="item">
</view-defails-form-modal>

<change-role-form-modal :item="item">
</change-role-form-modal>

<delete-user-form-modal :item="item">
</delete-user-form-modal>

</td>
</tr>
<tr>
  <td colspan="3">

    <invite-user :users="users" />

  </td>
</tr>
</table>



</div>
</div>

</template>

<style scoped>

</style>

<script>
export default {
  props: ['users'],

  mounted() {
  },
  data() {
    return {
      message: '',
      item: null,
      user: {}
    }
  },
  methods: {

    authIsAdmin: function () {
      var filtered = this.users.filter(function(item){
        return item.role == 'admin' && item.is_auth == true;
      }).length;
      if(filtered == 1) {
        return true;
      } else {
        return false;
      };
    },

    allowExit: function (item) {
      if(item.is_auth) {
        if(item.role == 'admin') {
          return this.allowDeleteAdmin()
        } else {
          return true;
        }
        return false;
      }
    },

    allowDeleteAdmin: function () {
      if(this.authIsAdmin) {
        return this.moreThan1Admin();
      } else {
        return false;
      };
    },
    moreThan1Admin: function () {
      var filtered = this.users.filter(function(item){
        return item.role == 'admin';
      }).length;
      if(filtered > 1) {
        return true;
      } else {
        return false;
      };
    },


    // authDelete: function(item){
    //   if(item.role == 'admin' && item.is_auth === false) {
    //     return true;
    //   } else {
    //     return false;
    //   }
    // },

  }
}
</script>
