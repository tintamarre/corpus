

<template>
  <!-- Application Profile -->
  <div class="row justify-content-center">
    <!-- Main -->
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <fa icon="search"></fa>

          {{ __("app.search") }} <small>{{ query }}</small>
        </div>
        <div class="card-body">
          <search-input :query="query" />

          <div v-if="!data_fetched" class="text-center">
            <loading-animation></loading-animation>
          </div>
          <div v-else>
            <div v-if="fields.didyoumean">
              <code>
                {{ __("app.nothing_to_show") }}
              </code>
              <samp class="text-muted text-sm">
                {{ __("app.did_you_mean") }}
              </samp>
            </div>
            <results :results="fields.results" />
          </div>
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
  props: ["query", "page_url"],
  mixins: [GetDataMixin],

  mounted() {},

  data() {
    return {};
  },
};
</script>
