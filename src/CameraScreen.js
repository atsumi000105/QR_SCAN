import React, { Component } from 'react'
import { View,Text,StyleSheet,Alert,TouchableOpacity,YellowBox,Linking,NetInfo } from "react-native";
import QRCodeScanner from 'react-native-qrcode-scanner';
YellowBox.ignoreWarnings(['Warning: isMounted(...) is deprecated', 'Module RCTImageLoader']);

export default class CameraScreen extends Component {
    static navigationOptions ={
        title:"Scan Barcode"
    }
  state = {
    isConnected: true
  }  ;
   
    read(e){
        console.log(e);
        Alert.alert("ok");
    }
    onSuccess(e) {


      //aksi anda
      // console.log(e);
      this.props.navigation.navigate('Detail');

      // const qr = e.data;
      // fetch(url).then(res => res.json())
      // .then(res=>{
      //   // console.log(res);
      //   if(res.status=="ok"){
      //     const data = res.data;
      //     this.props.navigation.navigate('Detail',{
      //       qr,
      //       data
      //     });
              
      //   }
      //   else{
      //     Alert.alert("Tidak Ada Data");
      //     this.scanner.reactivate();
      //   }
      // });
      // this.props.navigation.navigate('Detail',{
      //   qr
      // });
        // Linking
        //   .openURL(e.data)
        //   .catch(err => console.error('An error occured', err));
      }
    
  render() {
    
    return (
      <QRCodeScanner        
      reactivate={true}
        onRead={this.onSuccess.bind(this)}
        ref={(node) => { this.scanner = node }}
          containerStyle={styles.container}
        cameraStyle={styles.barcode}
        showMarker={true}
        markerStyle={styles.marker}
        customMarker={<CustomMarker/>}
        />
    )
  }
}

class CustomMarker extends Component{
  render(){
    return (
      <View style={styles.rectangleContainer}>
      <View style={styles.rectangle}/>
      </View>
    )
  }
}

const styles = StyleSheet.create({
    container: {
      justifyContent:"center",
      alignItems:"center",

    },
    centerText: {
      flex: 1,
      fontSize: 18,
      padding: 32,
      color: '#777',
    },
    textBold: {
      fontWeight: '500',
      color: '#000',
    },
    buttonText: {
      fontSize: 21,
      color: 'rgb(0,122,255)',
    },
    buttonTouchable: {
      padding: 16,
    },
    offlineText: { color: '#fff' },
    offlineContainer: {
      backgroundColor: '#b52424',
      height: 30,
      justifyContent: 'center',
      alignItems: 'center',
      flexDirection: 'row',
      position: 'absolute',
      top: 30
  },
  barcode:{
    height: 300,
    backgroundColor:'red',

    flex:1,
    alignItems:'center',
    backgroundColor:'transparent'
  },
  marker:{
    borderTopColor:'red',
    borderTopWidth:2,
    backgroundColor: 'red'
  },
  rectangleContainer:{
    flex:1,
    alignItems:'center',
    justifyContent:'center',
    backgroundColor:'transparent'
  },
  rectangle:{
    height:250,
    width: 250,
    borderWidth:2,
    borderColor: 'green',
    backgroundColor:'transparent'
  }
  });
  