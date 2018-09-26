import React, { Component } from 'react'
import { View,Text,Button,Image,StyleSheet,TouchableOpacity } from "react-native";
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
        <View style={styles.wrap}>
        <Image
        style={{width:100,height:100}}
        source={require('./assets/barcode.png')}/>
        <Text style={styles.textDesc}>Scan QR Code untuk memeriksa Tiket</Text>      
   
        <View style={styles.bottomView}>

            <TouchableOpacity
                        style={styles.btnScan}
                        onPress={()=>{this.props.navigation.navigate('Camera')}}
            >
              <Text style={styles.txtButtonScan}>SCAN BARCODE</Text>
            </TouchableOpacity>
        </View>
        </View>
    )
  }
}

const styles = StyleSheet.create({
  wrap:{
    backgroundColor:"#00a8ff",width:"100%",height:"100%",justifyContent:"center",alignItems:"center"
  },
  textDesc:{
    color: "#fff",
    fontSize: 15,
    marginTop: 30
  },
  bottomView:{
    height: 50,
    bottom: 0,
    position: "absolute",
    alignItems: "center",
  },
  btnScan:{
    
    backgroundColor: "transparent"
  },
  txtButtonScan:{
    color: "#fff",
    fontSize:18,
    fontWeight: "bold"
  }
});