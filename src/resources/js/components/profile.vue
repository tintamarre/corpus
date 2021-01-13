<template>
  <!-- Application Profile -->
  <div class="row justify-content-center">
    <div v-if="!data_fetched" class="text-center">
      <loading-animation></loading-animation>
    </div>
    <!-- Main -->
    <div class="col-md-8" v-else>
      <div class="card">
        <div class="card-header">
          <fa icon="user"></fa>
          {{ __("app.my_profile") }}
          <small>{{ fields.name }}</small>
        </div>
        <div class="card-body">
          <div v-if="!edit" class="table-responsive">
            <table class="table table-borderless table-sm">
              <tr>
                <th class="text-right">{{ __("app.name") }}</th>
                <td>
                  {{ fields.name }}
                </td>
              </tr>
              <tr>
                <th class="text-right">{{ __("app.email") }}</th>
                <td>
                  {{ fields.email }}
                </td>
              </tr>
              <tr>
                <th class="text-right">{{ __("app.phone") }}</th>
                <td>
                  {{ fields.phone }}
                </td>
              </tr>
              <tr>
                <th class="text-right">{{ __("app.country_code") }}</th>
                <td>
                  {{ fields.country_code }}
                </td>
              </tr>
            </table>

            <div class="pull-right">
              <button class="btn btn-primary" @click="edit = !edit">
                <fa icon="edit" />
                {{ __("app.edit") }}
              </button>
            </div>
          </div>

          <profile-form v-if="edit" :user="fields" />
        </div>
      </div>
    </div>
  </div>
</template>

<style>
</style>

<script>
import GetDataMixin from "../GetDataMixin";

export default {
  props: ["page_url"],
  mixins: [GetDataMixin],

  mounted() {},
  data() {
    return {
      edit: false,
    };
  },
};
</script>
