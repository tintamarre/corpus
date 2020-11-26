<template>
<div class="">

<alerts-inc :error="error" :success="success" />


    <form @submit.prevent="submitData">

      <div class="form-group">
        <label for="name">
          {{ __('app.name') }}
        </label>
        <input
        type="text"
        class="form-control"
        name="name"
        id="name"
        v-model="user.name" />

        <div v-if="errors && errors.name" class="text-danger">
          {{ errors.name[0] }}
        </div>
      </div>

      <div class="form-group">
        <label for="email">
          {{ __('app.email') }}
        </label>
        <input
        type="text"
        class="form-control"
        name="email"
        id="email"
        v-model="user.email" disabled />
      </div>


      <div class="form-group">
        <label for="phone">
          {{ __('app.phone') }}
        </label>
        <input
        type="phone"
        class="form-control"
        name="phone"
        id="phone"
        v-model="user.phone" />

        <div v-if="errors && errors.phone" class="text-danger">
          {{ errors.phone[0] }}
        </div>
      </div>


      <div class="form-group">
        <label for="country_code">
          {{ __('app.country_code') }}
        </label>
        <input
        type="country_code"
        class="form-control"
        name="country_code"
        id="country_code"
        v-model="user.country_code" />

        <div v-if="errors && errors.country_code" class="text-danger">
          {{ errors.country_code[0] }}
        </div>
      </div>

      <div class="pull-right">
        <button type="button"
        class="btn btn-secondary"
        @click="edit = !edit">
        <fa icon="ban" />
        {{ __('app.cancel') }}
      </button>
      <button type="submit" class="btn btn-success">
        <fa icon="save" />

        {{ __('app.save') }}
      </button>
    </div>

  </form>

</div>

</template>

<script>
import FormMixin from '../../FormMixin';

export default {
  mixins: [ FormMixin ],
  props: ['user'],

  data() {
    return {
      'action': '',
      'edit': ''
    }
  },
  methods: {
    submitData() {
      this.action = this.user.links.api_update;
      this.fields = this.user;
      this.submitPatch();
      this.fields = this.response_payload;
      this.edit = false;
    }
  }
}
</script>
