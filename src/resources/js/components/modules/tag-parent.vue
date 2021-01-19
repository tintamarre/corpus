<!-- Vue component -->
<template>
  <div class="row">
    <div class="col">
      <div>
        <!-- <label class="typo__label">
        <fa icon="tag"></fa>
      </label> -->
        <multiselect
          id="tag_select"
          v-model="value"
          :tag-placeholder="__('app.add_parent')"
          :placeholder="__('app.add_parent')"
          label="name"
          track-by="name"
          selectLabel="+"
          deselectLabel="-"
          :options="options"
          :multiple="false"
          :loading="isLoading"
          :taggable="false"
          class="small"
        >
        </multiselect>
      </div>

      <div class="pull-right">
        <button
          type="button"
          name="close"
          class="btn btn-sm small btn-secondary"
          @click="$emit('close-add-parent')"
        >
          <fa icon="times"></fa> {{ __("app.cancel") }}
        </button>

        <button
          type="button"
          name="addTag"
          @click="addTag"
          class="btn btn-sm small btn-success"
        >
          <fa icon="tag"></fa>
          {{ __("app.insert") }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect";
import FormMixin from "../../FormMixin";

export default {
  props: ["tag"],

  components: { Multiselect },
  mixins: [FormMixin],
  mounted() {
    this.fetchTagsData(this.tag.links.api_resources_parent_tags);
  },
  data() {
    return {
      page_url: null,
      value: [],
      options: [],
      error: null,
      errors: {},
      success: false,
      loaded: true,
      action: "",
      isLoading: false,
    };
  },
  methods: {
    fetchTagsData(page_url) {
      this.isLoading = true;
      axios
        .get(page_url)
        .then((response) => {
          if (response.status == 200) {
            this.options = response.data.data;
            this.isLoading = false;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    addTag() {
      const tag = {
        id: this.tag.id,
        tag_id: this.value.id,
      };
      this.action = this.tag.links.api_update;
      this.fields = tag;
      this.submitPatch();
      this.$emit("close-add-parent");
      this.$emit("reload-data");
      window.location.reload(false);
    },
  },
};
</script>


<!-- Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>
.multiselect__tags {
  min-height: 32px;
  display: block;
  padding: 3px 40px 0 8px;
  border-radius: 5px;
  border: 1px solid #e8e8e8;
  background: #fff;
  font-size: 14px;
}

.multiselect__tag {
  background: #428bca;
}

.multiselect__tag-icon:hover {
  background: #428bca;
}

.multiselect__tag-icon:focus:after,
.multiselect__tag-icon:hover:after {
  color: #428bca;
}
</style>
