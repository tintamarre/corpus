<template>
  <div class="row">
    <div class="col-sm-12 col-md-2 col-lg-2"></div>

    <div class="col-sm-12 col-md-8 col-lg-8">
      <p class="text-content" v-html="wrapContent"></p>

      <button @click="expandText" class="btn btn-sm btn-link">
        <fa icon="plus"></fa> {{ __("app.expand") }}
      </button>

      <button
        @click="revertText"
        v-if="expandedText"
        class="btn btn-sm btn-link"
      >
        <fa icon="minus"></fa> {{ __("app.reduce") }}
      </button>

      <div class="text-muted small text-right">
        <em>in</em> <a :href="snip.text.links.self">{{ snip.text.name }}</a>
        {{ __("app.tagged_by") }} <em>{{ snip.author }}</em>
      </div>
    </div>
    <div class="col-sm-12 col-md-2 col-lg-2 text-right">
      <button @click="deleteSnippet" class="btn btn-sm btn-link text-danger">
        <fa icon="trash"></fa> {{ __("app.delete") }} {{ __("app.snippet") }}
      </button>
      <!-- <button
    v-tooltip:top="'(this snippet will obsously disappear from this page after this operation)'"
    class="btn btn-sm btn-link text-secondary">
    <fa icon="edit"></fa> {{ __('app.rename_tag_for_this_instance_only') }}
  </button> -->
    </div>
  </div>
</template>

<style>
</style>

<script>
import FormMixin from "../../FormMixin";

export default {
  props: ["snip"],
  mixins: [FormMixin],

  mounted() {},
  computed: {
    wrapContent() {
      return (
        '<span class="text-muted">...</span> ' +
        this.snip.segment_content.substring(
          this.snip.snippet_start - this.offset,
          this.snip.snippet_start
        ) +
        "<span class='bg-warning'>" +
        this.snip.segment_content.substring(
          this.snip.snippet_start,
          this.snip.snippet_end
        ) +
        "</span>" +
        this.snip.segment_content.substring(
          this.snip.snippet_end,
          this.snip.snippet_end + this.offset
        ) +
        ' <span class="text-muted">...</span>'
      );
    },
  },
  methods: {
    expandText() {
      this.offset = this.offset + 160;
      this.expandedText = true;
    },
    revertText() {
      (this.offset = 50), (this.expandedText = false);
    },
    deleteSnippet() {
      this.action = this.snip.links.api_destroy;
      this.submitDelete();
      // this.$delete(this.snip, this.snip.id);
      this.$emit("reload-data");
    },
  },
  data() {
    return {
      expandedText: false,
      offset: 50,
    };
  },
};
</script>
