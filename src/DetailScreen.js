import React, { Component } from 'react'
import {Text,View,StyleSheet} from "react-native";
import { Card, ListItem, Button,Icon } from 'react-native-elements'


export default class DetailScreen extends Component {
    static navigationOptions ={
        title:"Detail Tiket "
    }
constructor(props) {
  super(props)

  console.log("ok kak");

    const params = this.props.navigation.state.params;
    const data = params.data;
  this.state = {
     data: data
  }

console.log(this.state.data);
}


  render() {
      if(this.state.data.status_bayar==0){

        bayar = <Text style={styles.text}>Belum Bayar</Text>;
      }
      else{
          bayar = <Text style={styles.text}>Lunas</Text>;
      }
    return (
        <View >
       
<Card title="Info Tiket">
  <View>

  <Text style={styles.text}>{"#"+this.state.data.id}</Text>
  <Text style={styles.subText}>Nomor Transaksi</Text>
</View>
  <View>

  <Text style={styles.text}>{this.state.data.harga_akhir}</Text>
  <Text style={styles.subText}>Harga Total</Text>
</View>

  <View>
      {bayar}
  <Text style={styles.subText}>Status</Text>
</View>

       


</Card>
        </View>
    )
  }
}

const styles = StyleSheet.create({
    icon:{
        flex: 1,
        flexDirection: 'row',
        justifyContent: 'flex-start',

    },
    text: {
        fontSize: 40,
        textAlign: 'center'
    },
    subText: {
        fontSize: 20,
        textAlign: 'center'
    }
})