<template>
  <div>
    <button
      @click="add_new = !add_new"
      class="btn btn-outline btn-sm btn-success"
      v-if="!add_new"
    >
      <fa icon="user-plus" />
      {{ __("app.add_new") }}
    </button>

    <div v-if="add_new">
      <form
        class=""
        :action="users[0].links.api_store + '?api_token=' + apiToken"
        method="post"
      >
        <div class="form-group">
          <input
            type="text"
            name="email"
            value=""
            class="form-control"
            :placeholder="__('app.search_user')"
          />
        </div>

        <input type="hidden" name="_token" id="csrf-token" :value="csrfToken" />

        <div class="form-group pull-right" v-if="add_new">
          <button
            @click="add_new = !add_new"
            class="btn btn-secondary btn-sm btn-default"
          >
            <fa icon="ban" />

            {{ __("app.cancel") }}
          </button>

          <button type="submit" class="btn btn-outline btn-sm btn-primary">
            <fa icon="user-plus" />
            {{ __("app.search") }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>
</style>

<script>
export default {
  props: ["users"],
  mounted() {
    this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    this.apiToken = document.querySelector('meta[name="api-token"]').content;
  },
  data() {
    return {
      add_new: false,
      csrfToken: "",
      apiToken: "",
    };
  },
};
</script>
