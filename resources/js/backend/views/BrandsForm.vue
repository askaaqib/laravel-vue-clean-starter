<template>
  <div>
    <form @submit.prevent="onSubmit">
      <b-row>
        <b-col xl="8">
          <b-card>
            <h3 class="card-title" slot="header">{{ isNew ? $t('labels.backend.brands.titles.create') : $t('labels.backend.brands.titles.edit') }}</h3>
            <b-form-group
              :label="$t('validation.brands.name')"
              label-for="name"
              horizontal
              :label-cols="2"
              :feedback="feedback('name')"
            >
              <b-form-input
                id="name"
                name="name"
                required
                :placeholder="$t('validation.brands.name')"
                v-model="model.name"
                :state="state('name')"
              ></b-form-input>
            </b-form-group>

            <b-row slot="footer">
              <b-col md>
                <b-button to="/brands" exact variant="danger" size="md">
                  {{ $t('buttons.back') }}
                </b-button>
              </b-col>
              <b-col md>
                <input name="status" type="hidden" value="publish">

                <b-button right split :text="$t('buttons.brands.save_and_publish')" class="float-right"
                          variant="success" size="sm" @click="model.status = 'publish'; onSubmit()"
                          :disabled="pending"
                          v-if="isNew || this.$app.user.can('edit brands') || this.$app.user.can('edit own brands')"
                >Save
                </b-button>
              </b-col>
            </b-row>
          </b-card>
        </b-col>
      </b-row>
    </form>
  </div>
</template>

<script>
import inventoryform from '../mixins/inventoryform'

export default {
  name: 'BrandsForm',
  mixins: [inventoryform],
  data() {
    return {
      modelName: 'brand',
      resourceRoute: 'brands',
      listPath: '/brands',
      model: {
        name: null
      }
    }
  }
}
</script>
