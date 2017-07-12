namespace php service.test

include "base.thrift"

/** 消息包头,用于所有外部请求包 */
struct MsgHeader
{
    1: i32 uid;
}

struct testReq
{
    1: MsgHeader header;
    2: string name;

}

struct TestResp
{
	1:i32 age;
}
