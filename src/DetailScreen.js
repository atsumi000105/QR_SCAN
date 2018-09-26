import React, { Component } from 'react'
import {Text,View,StyleSheet,Image,YellowBox} from "react-native";
import { Card, ListItem, Button,Icon } from 'react-native-elements'
const {width, height} = require('Dimensions').get('window');
YellowBox.ignoreWarnings(['Warning: isMounted(...) is deprecated', 'Module RCTImageLoader']);


export default class DetailScreen extends Component {
    static navigationOptions ={
        title:"Detail Tiket "
    }
constructor(props) {
  super(props)



    const params = this.props.navigation.state.params;
//     const data = params.data;
//   this.state = {
//      data: data
//   }

// console.log(this.state.data);
}


  render() {
    //   if(this.state.data.status_bayar==0){

    //     bayar = <Text style={styles.text}>Belum Bayar</Text>;
    //   }
    //   else{
    //       bayar = <Text style={styles.text}>Lunas</Text>;
    //   }
    return (
        <View style={styles.withBackground}>
       
<Card >
  <View>
<View style={{alignItems:'center'}}>
<Image 
source={{uri:'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/220px-QR_code_for_mobile_English_Wikipedia.svg.png'}}
style={{width: 100, height: 100}}
/>
</View>
  <Text style={styles.text}>INVOICE</Text>
  <Text style={styles.subText}>#123</Text>
</View>
  <View>

  <Text style={styles.text}>USER</Text>
  <Text style={styles.subText}>budi santoso</Text>
</View>


  <View>

<Text style={styles.text}>TOTAL</Text>
<Text style={styles.subTextPrice}>Rp.20.000,000</Text>
</View>

       


</Card>
<Card flexDirection='row'>
  <View style={{flex: 6}}>
    <Text style={{fontWeight: 'bold', marginBottom: 5}}>
      Tanggal
    </Text>
    <Text style={{marginBottom: 5}}>
      12 Januari 2019
    </Text>
  </View>
  <View style={{flex: 6, flexDirection: 'column'}}>
    <Text style={{fontWeight: 'bold', marginBottom: 5}}>
      Event
    </Text>
    <Text style={{marginBottom: 5}}>
      Lomba Lari 100KM
    </Text>
  </View>
</Card>
        </View>
    )
  }
}

const styles = StyleSheet.create({
    withBackground:{
backgroundColor : "#00a8ff",
height: "100%",
width: "100%"
    },
    icon:{
        flex: 1,
        flexDirection: 'row',
        justifyContent: 'flex-start',

    },
    text: {
        fontSize: 15,
        textAlign: 'center',
        borderStyle: 'solid',
    },
    subText: {
        fontSize: 20,
        color: '#333',
        textAlign: 'center',
        borderBottomWidth: 1,
        marginBottom:20,
        marginTop:5,
        borderBottomColor: '#eee'
    },
    subTextPrice: {
        fontSize: 20,
        color: 'red',
        textAlign: 'center',
        marginBottom:20,
        marginTop:5,
    }
})