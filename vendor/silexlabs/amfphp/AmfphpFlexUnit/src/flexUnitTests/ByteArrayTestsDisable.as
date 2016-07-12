package flexUnitTests
{
	import flash.events.Event;
	import flash.net.FileReference;
	import flash.net.ObjectEncoding;
	import flash.net.URLLoader;
	import flash.net.URLLoaderDataFormat;
	import flash.net.URLRequest;
	import flash.utils.ByteArray;
	
	import mx.rpc.events.FaultEvent;
	import mx.rpc.events.ResultEvent;
	import mx.rpc.remoting.RemoteObject;
	
	import flexunit.framework.TestCase;
	
	import org.amfphp.test.EnhancedNetConnection;
	import org.amfphp.test.ExternalizableDummy;
	import org.amfphp.test.ObjEvent;

	/**
	 * testing with uploading byte array. named xxxxDisable to avoid being included in test runner generated by ant task, 
	 * as it doesn't work with ant(needs to copy cc-logo.jpg to target dir)
	 */
	public class ByteArrayTestsDisable extends TestCase
	{		
		private var _myConnection:RemoteObject;		
		private var _urlLoader:URLLoader;
		
		[Before]
		override public function setUp():void
		{
			_myConnection = new RemoteObject;	
			
			_myConnection.destination = "bla"; 
			_myConnection.endpoint = TestConfig.gateway;
			_myConnection.source = "ByteArrayTestService";
			_urlLoader = new URLLoader();
			_urlLoader.dataFormat = URLLoaderDataFormat.BINARY;
			_urlLoader.addEventListener(Event.COMPLETE, onComplete);
		}

		private function onComplete(event:Event):void
		{
			var data:Array = new Array();
			var byteArray:ByteArray = _urlLoader.data;
			byteArray.compress();
			data.push(byteArray);
			
			var byteArray2:ByteArray = new ByteArray();
			byteArray2.writeBoolean(true);
			data.push(byteArray2);
			
			_myConnection.uploadCompressedByteArray(data);
			
			_myConnection.addEventListener(ResultEvent.RESULT, addAsync(sendingAndReceivingACompressedImageResultHandler, 3000));
			
		}

		
		public function testSendingAndReceivingACompressedImage():void{
			_urlLoader.load(new URLRequest("cc-logo.jpg"));
		}

		
		
		public function sendingAndReceivingACompressedImageResultHandler(event:ResultEvent):void{
			assertTrue(event.result);
		}
	}
}