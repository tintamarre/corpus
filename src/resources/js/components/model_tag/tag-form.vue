<template>
  <div class="row">
    <div class="col-sm-9 col-md-9 col-lg-9">
      <div v-if="!editTag">

        <div class="row">
          <div class="col-sm-3 col-md-3 col-lg-3 text-right">
            <span class="text-muted text-uppercase">
              <strong>{{ __('app.parent') }}</strong>
            </span>
          </div>
          <div class="col-sm-9 col-md-9 col-lg-9">
            <div v-if="tag.parent">
              <a
              class="btn btn-primary btn-sm small" :style="colorTag(tag.parent.color)"
              :href="tag.parent.links.self">
              <fa icon="tag"></fa> {{ tag.parent.name }}
            </a>

            <button type="button"
            name="button"
            class="btn btn-sm btn-link"
            @click="deleteParent">
            <fa icon="trash"></fa>
            {{ __('app.delete') }} {{ __('app.parent') }}</button>
          </div>

          <div v-else>

          <button v-if="!addParent"
          type="button" name="button"
          class="btn btn-sm btn-link"
          @click="addParent = !addParent">
          <fa icon="plus"></fa> {{ __('app.add') }} {{ __('app.parent') }}
        </button>

        <div v-if="addParent">

          <label for="parent_tag">
            {{ __('app.parent_tag') }}
          </label>
          <tag-parent
          name="parent_tag"
          :value="tag.parent"
          v-model="tag.parent"
          :tag="tag"
          v-on="$listeners"
          @close-add-parent="addParent = !addParent"
          />
        </div>

      </div>


    </div>
  </div>
  <div class="row">
    <div class="col-sm-3 col-md-3 col-lg-3 text-right">
      <span class="text-muted text-uppercase">
        <strong>{{ __('app.tag') }}</strong>
      </span>
    </div>
    <div class="col-sm-9 col-md-9 col-lg-9">
      <button class="btn btn-primary btn-sm small"
      :style="colorTag(tag.color)">
      <fa icon="tag"></fa> {{ tag.name }}
    </button>
  </div>
</div>

<div class="row">
  <div class="col-sm-3 col-md-3 col-lg-3 text-right">
    <span class="text-muted text-uppercase">
      <strong>{{ __('app.children') }}</strong>
    </span>
  </div>
  <div class="col-sm-9 col-md-9 col-lg-9">
    <p v-if="tag.children && tag.children.length != 0">
      <a v-for="child in tag.children"
      class="btn btn-primary btn-sm small"
      :style="colorTag(child.color)"
      :href="child.links.self">
      <fa icon="tag"></fa> {{ child.name }}
    </a>
  </p>
</div>
</div>

<div class="row">
  <div class="col-sm-3 col-md-3 col-lg-3 text-right">
    <span class="text-muted text-uppercase">
      <strong>{{ __('app.description') }}</strong>
    </span>
  </div>
  <div class="col-sm-9 col-md-9 col-lg-9">
    <p>
      {{ tag.description || __('app.nothing_to_show') }}
    </p>
  </div>
</div>



</div>




<div v-if="editTag">
  <h2>{{ __('app.edit_tag') }}</h2>
  <form class="form-group" @submit.prevent="updateTag">

    <div class="row">
      <div class="col">
        <label for="name">{{ __('app.rename_tag_for_all_instances_of_this_tag') }}</label>
        <input type="text" name="name" v-model="tag.name" class="form-control">

      </div>
      <div class="col text-center">
        <button type="button"
        @click="changeColor(color)"
        v-for="color in JSON.parse(colors)"
        class="btn btn-small"
        v-tooltip:top="__('app.select_this') + ' ' + __('app.color').toLowerCase() + ' '">
        <svg width="25" height="25">
          <rect width="25" height="25"
          :stroke="color"
          :fill="color" />
        </svg>
      </button>
    </div>

  </div>

  <div class="row">
    <div class="col">
      <label for="description">{{ __('app.description') }}</label>
      <textarea name="description" v-model="tag.description" rows="8" cols="80" class="form-control">

      </textarea>

    </div>

  </div>

  <!-- <h2>Graph of relations</h2>
  visjs object -->


  <div class="row">
    <div class="col">

      <div class="pull-right">

        <button type="button"
        name="button"
        class="btn btn-secondary"
        @click="cancel">
        <fa icon="times"></fa> {{ __('app.cancel') }}
      </button>

      <button
      type="submit"
      name="button"
      class="btn btn-success">
      <fa icon="save"></fa> {{ __('app.save') }}
    </button>
  </div>
</div>
</div>

</form>


</div>

</div>
<div class="col-sm-3 col-md-3 col-lg-3">
  <h5 class="text-muted text-uppercase">
    <strong>
      {{ __('app.actions') }}
    </strong>
  </h5>

  <button type="button" name="button"
  @click="editTag =!editTag"
  class="btn btn-link">
  <fa icon="edit"></fa>
</button>

<div v-if="editTag">


<h5 class="text-muted text-uppercase">
  <strong>
    {{ __('app.preview') }}
  </strong>
</h5>
<button class="btn btn-primary btn-sm small"
:style="colorTag(tag.color)">
<fa icon="tag"></fa> {{ tag.name }}
</button>
</div>


</div>
</div>
</template>

<style>

</style>

<script>
import FormMixin from '../../FormMixin';

export default {
  props: ['tag', 'colors'],
  mixins: [ FormMixin ],

  mounted() {
  },
  data() {
    return {
      action: null,
      editTag: false,
      addParent: false,
    }
  },

  methods: {
    colorTag(color) {
      return {
        backgroundColor: color,
        borderColor: color
      };
    },
    cancel() {
      this.editTag = false;
      this.$emit('reload-data');
    },
    updateTag() {
      const tag = {
        id: this.tag.id,
        name: this.tag.name,
        color: this.tag.color,
        description: this.tag.description,
      };
      this.action = this.tag.links.api_update;
      this.fields = tag;
      this.submitPatch();
      this.editTag = false;
      window.location.reload(false); 
      // this.$emit('reload-data');
    },

    deleteParent() {
      const tag = {
        id: this.tag.id,
        name: this.tag.name,
        color: this.tag.color,
        description: this.tag.description,
        tag_id: null
      };
      this.action = this.tag.links.api_update;
      this.fields = tag;
      this.submitPatch();
      this.tag.parent = null;
      // this.$emit('reload-data');
    },

    changeColor(color) {
      this.tag.color = color;
    },
  }
}
</script>
