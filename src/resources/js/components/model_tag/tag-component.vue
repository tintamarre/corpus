<template>
  <div class="">
    <div class="card-header">
      <fa icon="tag"></fa>
      {{ fields.name }}
    </div>

    <div class="card-body">
      <div class="row" v-if="!data_fetched">
        <div class="col-md-12 text-center">
          <loading-animation />
        </div>
      </div>
      <div v-else>
        <tag-form :tag="fields" :colors="colors" @reload-data="reloadData" />

        <hr v-if="fields.tagscloud.data.length != 0" />

        <div class="row" v-if="fields.tagscloud.data.length != 0">
          <div class="col-sm-2 col-md-2 col-lg-2 text-right">
            <span class="text-muted text-uppercase">
              <strong>{{ __("app.tagcloud") }}</strong>
            </span>
          </div>
          <div class="col-sm-8 col-md-8 col-lg-8">
            <ul class="nav justify-content-center">
              <li v-for="item in fields.tagscloud.data">
                <tag-span :item="item"></tag-span>
              </li>
            </ul>
          </div>

          <div class="col-sm-2 col-md-2 col-lg-2 text-right"></div>

          <div class="col-sm-2 col-md-2 col-lg-2 text-right">
            <span class="text-muted text-uppercase">
              <strong>{{ __("app.graph") }}</strong>
            </span>
          </div>
          <div class="col-sm-8 col-md-8 col-lg-8">
            <tag-chart
              v-if="fields.links"
              :page_url="fields.links.api_tag_graph"
            />
          </div>

          <div class="col-sm-2 col-md-2 col-lg-2 text-right"></div>
        </div>
        <hr />

        <div class="row">
          <div class="col-sm-12 col-md-2 col-lg-2">
            <span class="text-muted text-uppercase text-right">
              <strong>{{ __("app.snippets") }}</strong>
            </span>
          </div>
          <div class="col-sm-12 col-md-8 col-lg-8">
            <h3>
              <fa icon="tag" class="lightgray small"></fa> {{ fields.name }}
            </h3>
          </div>
          <div class="col-sm-12 col-md-2 col-lg-2 text-right">
            <span class="text-muted text-uppercase">
              <strong>{{ __("app.actions") }}</strong>
            </span>
          </div>
        </div>

        <div v-for="snip in fields.snippets" :key="snip.id">
          <tag-segment :snip="snip" @reload-data="reloadData" />
        </div>

        <div
          v-if="fields.children.length != 0"
          v-for="child in fields.children"
          :key="child.id"
        >
          <hr />
          <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2">
              <span class="text-muted text-uppercase">
                <strong
                  >{{ __("app.children") }} {{ __("app.snippets") }}</strong
                >
              </span>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8">
              <h3>
                <fa icon="tag" class="lightgray small"></fa> {{ child.name }}
              </h3>
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2">
              <span class="text-muted text-uppercase">
                <strong>{{ __("app.actions") }}</strong>
              </span>
            </div>
          </div>

          <div v-for="snip in child.snippets" :key="snip.id">
            <tag-segment :snip="snip" @reload-data="reloadData" />
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
  mixins: [GetDataMixin],
  props: ["page_url", "colors"],
  data() {
    return {};
  },
  mounted() {},
  created() {},
  methods: {
    reloadData() {
      this.fetchData(this.page_url);
    },
  },
};
</script>
