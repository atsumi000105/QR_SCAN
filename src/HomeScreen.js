import React, { Component } from 'react'
import { View,Text,Button } from "react-native";
export default class HomeScreen extends Component {
    static navigationOptions ={
        title:"Home"
    }
    constructor(props) {
      super(props)
    console.log("ok");
      this.state = {
         
      }
    }
    
  render() {
    return (
        <View>
            <Text>Halo</Text>
            <Button
            title="Button"
            onPress={()=>{this.props.navigation.navigate('Camera')}}
            ></Button>
        </View>
    )
  }
}
