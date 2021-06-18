<template>
  <div>

    <div v-if="!data_fetched" class="text-center">
      <loading-animation></loading-animation>
    </div>

    <div v-else>
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <h1 v-text="fields.name"></h1>
        </div>
      </div>


      <div class="row">
        <div class="col-md-8 col-lg-8">

          <p v-text="fields.description">
          </p>

          <h3>
            {{ __('app.classification') }}
            <small>{{ fields.relationships.labels.data.length }}</small>
          </h3>

          <div class="" id="labels">

            <table class="table">

              <tr v-for="item in fields.relationships.labels.data">
                <td class="text-right">
                  <a class="btn btn-sm btn-primary"
                  :href="item.links.self"
                  :key="item.id"
                  >
                  <fa icon="layer-group"></fa>
                  {{ item.name }}
                  <span class="badge badge-success badge-pill">
                    {{ item.label_texts_count }}
                  </span>
                </a>


              </td>
              <td>
                <!-- <pre>{{ item.attributes_grouped }}</pre> -->
                <attributes-span
                :attributes="item.attributes" />

              </td>
            </tr>

          </table>

        </div>

        <h3>{{ __('app.tagcloud') }}
          <small>{{ fields.relationships.tagscloud.data.length }}</small>
        </h3>

        <div class="text-center">
          <tag-span v-for="item in fields.relationships.tagscloud.data" :key="item.id" :item="item" />
        </div>

      </div>

      <div class="col-md-4 col-lg-4">
        <!-- <h2>
        {{ __('app.activity') }}
      </h2>
      <ul>
      <li>
      <samp class="small">
      <a href="#">User deleted: Martin</a>
      <fa icon="calendar-check"></fa>
    </samp>
  </li>
</ul> -->


<h2>
  {{ __('app.statistics') }}
  <!-- <button @click="resetCached"
  v-tooltip:top="__('app.cached') + ': ' + fields.datetimes.cached_at_diff + ' (' + __('app.click_to_reset_cache') + ')'"
  class="small btn btn-link text-muted"
  ><fa icon="info-circle"></fa>
</button> -->
</h2>

<div class="table-responsive-sm">
  <table class="table table-sm">
    <tr
    v-for="item in fields.relationships.stats.data"
    :key="item.id"
    class="">
    <th v-text="item.trans"></th>
    <td v-text="item.value" class="text-right"></td>
  </tr>
</table>

</div>

<h2>
  {{ __('app.analysis') }}
</h2>

<div class="table-responsive-sm">
  <table class="table table-sm">
    <tr>
      <td>Codebook</td>      
      <td class="text-right">
        <a :href="fields.links.self + '/codebook'" class="btn btn-sm btn-primary">
         {{ __('app.download') }} <fa icon="download"></fa>
        </a>
      </td>
  </tr>
</table>

</div>

<collection-users
:users="fields.relationships.users.data"
/>



</div>

</div>


</div>
</div>

</div>
</template>

<style scoped>
</style>

<script>
import GetDataMixin from "../../GetDataMixin";

export default {
  props: ["page_url"],
  mixins: [GetDataMixin],
  computed: {},
  mounted() {},
  methods: {
    resetCached() {
      // set cached to null;
      // refresh;
    },
  },
  // data() {
  //   return {
  //   }
  // }
};
</script>
