<template>
  <div>
    <b-card>
      <template slot="header">
        <div class="card-options" v-if="this.$app.user.can('create brands')">
          <b-button to="/brands/create" variant="success" size="sm">
            <i class="fe fe-plus-circle"></i> {{ $t('buttons.brands.create') }}
          </b-button>
        </div>
      </template>
      <b-datatableinventory 
        ref="datasource"
        @context-changed="onContextChanged"
        search-route="admin.brands.search"
        delete-route="admin.brands.destroy"
        action-route="admin.brands.batch_action" :actions="actions"
        :selected.sync="selected"
      >
        <b-table ref="datatable"
                 striped
                 show-empty
                 stacked="md"
                 no-local-sorting
                 :empty-text="$t('labels.datatables.no_results')"
                 :empty-filtered-text="$t('labels.datatables.no_matched_results')"
                 :fields="fields"
                 :items="dataLoadProvider"
                 sort-by="brands.created_at"
                 :sort-desc="true"
        >
          <template slot="HEAD_checkbox" slot-scope="data"></template>
          <template slot="checkbox" slot-scope="row">
            <b-form-checkbox :value="row.item.id" v-model="selected"></b-form-checkbox>
          </template>
          <template slot="name" slot-scope="row">
            <b-button v-if="row.item.id" size="sm" variant="link" :to="`/brands/${row.item.id}/edit`">
              <span v-text="row.item.name"></span>
            </b-button>
          </template>
          <template slot="items_count" slot-scope="row">
            <span v-text="row.item.items_count"></span>
          </template>
          <template slot="brand.created_at" slot-scope="row">
            {{ row.item.created_at }}
          </template>
          <template slot="brand.updated_at" slot-scope="row">
            {{ row.item.updated_at }}
          </template>
          <template slot="actions" slot-scope="row">
            <b-button v-if="row.item.id" size="sm" variant="danger" v-b-tooltip.hover :title="$t('buttons.delete')" @click.stop="onDelete(row.item.id)">
              <i class="fe fe-trash"></i>
            </b-button>
          </template>
        </b-table>
      </b-datatableinventory>
    </b-card>
  </div>
</template>

<script>
export default {
  name: 'BrandsList',
  data() {
    return {
      selected: [],
      fields: [
        { key: 'checkbox' },
        {
          key: 'name',
          label: this.$t('validation.brands.name'),
          sortable: true
        },
        {
          key: 'items_count',
          label: this.$t('validation.brands.items_count'),
          sortable: true
        },
        { key: 'actions', label: this.$t('labels.actions'), class: 'nowrap' }
      ],
      actions: {
        destroy: this.$t('labels.backend.brands.actions.destroy')
      }
    }
  },
  methods: {
    dataLoadProvider(ctx) {
      return this.$refs.datasource.loadData(ctx.sortBy, ctx.sortDesc)
    },
    onContextChanged() {
      return this.$refs.datatable.refresh()
    },
    onDelete(id) {
      this.$refs.datasource.deleteRow({ brand: id })
    }
  }
}
</script>
