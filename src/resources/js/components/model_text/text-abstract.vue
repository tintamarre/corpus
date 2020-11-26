<template>
  <div>
    <form @submit.prevent="submit">

      <div class="row">
        <div class="col-md-2 col-lg-2 col-sm-2 text-right text-muted">
          <h5>{{ __('app.name') }}</h5>
        </div>

        <div class="col-sm-8 col-md-8 col-lg-8">
          <div v-if="!editText">
            <h1 class="lead">{{ text.name }}</h1>
          </div>
          <div v-else class="form-group">
            <label for="name">{{ __('app.name') }}</label>
            <input type="text" name="name" v-model="text.name" class="form-control">
          </div>
          <hr>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
          <button type="button"
          @click="editText = !editText"
          class="btn btn-link btn-sm">
            <fa icon="edit"></fa>
            {{ __('app.edit') }}
          </button>
        </div>
      </div>

      <div class="row">

        <div class="col-md-2 col-lg-2 col-sm-2 text-right text-muted">
          <h5>{{ __('app.abstract') }}</h5>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8">
          <div v-if="!editText">
            <p class="mb-0 abstract">
                {{ text.abstract }}
            </p>
          </div>
          <div v-else class="form-group">
            <label for="abstract">{{ __('app.abstract') }}</label>
            <textarea name="abstract" v-model="text.abstract" rows="8" cols="80" class="form-control"></textarea>

            <div class="pull-right">
              <button
              type="button"
              @click="editText = !editText"
              class="btn btn-outline-secondary">
              <fa icon="times"></fa>
              {{ __('app.cancel') }}
            </button>

            <button @click="submitData" class="btn btn-success">
              <fa icon="save"></fa>
              {{ __('app.save') }}
            </button>

          </div>

        </div>

      </div>

      <div class="col-sm-2 col-md-2 col-lg-2">

      </div>

    </div>
  </form>

</div>
</template>

<style>
/* blockquote{
border: 0.5px solid #ccc;
padding: 20px 5px 20px 5px;
border-radius: 10px;
} */
.abstract {
  color: ccc#;

}
</style>

<script>
import FormMixin from '../../FormMixin';

export default {
  props: ['text', 'links'],
  mixins: [ FormMixin ],
  mounted() {
  },
  data() {
    return {
      'action': this.links.api_update,
      'editText': false,
      'fields': {}
    }
  },
  methods: {
    submitData() {
      this.fields.name = this.text.name;
      this.fields.abstract = this.text.abstract;
      this.submitPatch();
      this.editText = false;
      window.location.href = "/portfolio" // stupid solution for quick fix
    },
  }
}
</script>
