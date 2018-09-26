/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 * @flow
 */

import React, {Component} from 'react';
import {Platform, StyleSheet, Text, View} from 'react-native';

import {createStackNavigator} from 'react-navigation';
import CameraScreen from './src/CameraScreen';
import HomeScreen from './src/HomeScreen';
import DetailScreen from './src/DetailScreen';

const instructions = Platform.select({
  ios: 'Press Cmd+R to reload,\n' + 'Cmd+D or shake for dev menu',
  android:
    'Double tap R on your keyboard to reload,\n' +
    'Shake or press menu button for dev menu',
});

type Props = {};

const Screen = createStackNavigator({
  Home: {
    screen: HomeScreen,
    navigationOptions: {
      header:null
    }
  },
  Camera:{
    screen: CameraScreen,
    navigationOptions: {
      headerTintColor: "#fff",
      headerStyle: {
        backgroundColor: '#00a8ff',
        shadowOpacity: 0,
        shadowRadius:0,
        elevation: 0
      },

    }
  },
  Detail:{
    screen : DetailScreen,
    navigationOptions: {
      headerTintColor: "#fff",
      headerStyle: {
        backgroundColor: '#00a8ff',
        shadowOpacity: 0,
        shadowRadius:0,
        elevation: 0
      },

    }
  }
})
export default class App extends Component<Props> {
  render() {
    return (
      <Screen/>
    );
  }
}
