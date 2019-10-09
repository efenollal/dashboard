<template>
  <v-app>
    <v-navigation-drawer v-model="drawer" app clipped>
      <v-list dense>
        <v-list-item to="/">
          <v-list-item-action>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item to="/domains">
          <v-list-item-action>
            <v-icon>mdi-earth</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Domains</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item to="/settings">
          <v-list-item-action>
            <v-icon>mdi-settings</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Settings</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item to="/code-challenge">
          <v-list-item-action>
            <v-icon>mdi-help-circle</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Code Challenge</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app clipped-left>
      <v-app-bar-nav-icon @click.stop="toggleDrawer" />
      <v-toolbar-title>Bodis</v-toolbar-title>
    </v-app-bar>

    <v-content>
        <slot name="content"></slot>
    </v-content>

    <v-footer app>
      <span>Code Challenge</span>
    </v-footer>
  </v-app>
</template>

<script>
  import store from '../store';

  export default {
    store,
    data: () => ({
        drawer: null,
    }),
    created () {
        this.$vuetify.theme.dark = this.$store.getters['settings/isDarkMode'];
    },
    methods: {
        toggleDrawer() {
            this.drawer = !this.drawer;
        }
    }
  }
</script>
