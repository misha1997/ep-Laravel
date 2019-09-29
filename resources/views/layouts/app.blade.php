<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user" content="{{ Auth::user() }}">
    <link rel="manifest" href="/manifest.json">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-corner-indicator.min.css" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<v-app id="app" v-cloak>
    <snack-bar-component></snack-bar-component>
    <v-navigation-drawer
            fixed
            clipped
            app
            width="250"
            v-model="drawer"
    >
        <v-list dense>
            <template v-for="(item, i) in items">
                <template v-if="checkRoles(item)">
                    <v-layout
                            row
                            v-if="item.heading"
                            align-center
                            :key="i"
                    >
                        <v-flex xs6>
                            <v-subheader v-if="item.heading">
                                @{{ item.heading }}
                            </v-subheader>
                        </v-flex>
                    </v-layout>
                    <v-list-group v-else-if="item.children" v-model="item.model" no-action>
                        <v-list-tile slot="item" @click="menuItemSelected(item)">
                            <v-list-tile-action>
                                <v-icon>@{{ item.model ? item.icon : item['icon-alt'] }}</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    @{{ item.text }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile
                                v-for="(child, i) in item.children"
                                :key="i"
                                @click="menuItemSelected(child)"
                        >
                            <v-list-tile-action v-if="child.icon">
                                <v-icon>@{{ child.icon }}</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    @{{ child.text }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list-group>
                    <v-list-tile v-else @click="menuItemSelected(item)">
                        <v-list-tile-action>
                            <v-icon>@{{ item.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                @{{ item.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>
            </template>
        </v-list>
    </v-navigation-drawer>
    <v-toolbar
            color="blue darken-3"
            dark
            app
            clipped-left
            clipped-right
            fixed
    >
        <v-toolbar-title :style="$vuetify.breakpoint.smAndUp ? 'width: 300px; min-width: 250px' : 'min-width: 72px'" class="ml-0 pl-3">
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <span class="hidden-xs-only">{{ config('app.shortname', 'Laravel') }}</span>
        </v-toolbar-title>
        <div class="d-flex align-center" style="margin-left: auto">
            <v-btn flat>Вихід</v-btn>
        </div>
    </v-toolbar>

    <v-content class="ma-3">
        @yield('content')
    </v-content>
</v-app>
@stack('beforeScripts')
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
@stack('afterScripts')
</body>
</html>
